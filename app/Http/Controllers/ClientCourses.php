<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;

class ClientCourses extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config("services.midtrans.serverKey");
        \Midtrans\Config::$isProduction = config(
            "services.midtrans.isProduction"
        );
        \Midtrans\Config::$isSanitized = config(
            "services.midtrans.isSanitized"
        );
        \Midtrans\Config::$is3ds = config("services.midtrans.is3ds");
    }

    public function home()
    {
        $data = Course::latest()->take(8)->get();
        return view("pages.index", compact("data"));
    }
    public function course()
    {
        $data = Course::all();
        return view("pages.kursus", compact("data"));
    }
    public function detail($name)
    {
        $course = Course::where("nama", $name)
            ->with([
                "subCourses" => function ($query) {
                    $query->take(4);
                },
            ])
            ->first();
        // Total kursus
        $totalSubCourses = $course->subCourses()->count() - 4;
        $total = max($totalSubCourses - 4, 0);
        // Kursus Lainnya
        $relatedCourses = Course::where("id", "!=", $course->id)
            ->take(4)
            ->get();
        $preview = $course->subCourses->firstWhere("id", 1)?->link;
        return view(
            "pages.detail",
            compact("course", "total", "preview", "relatedCourses")
        );
    }

    // Cart dynamic
    public $cart = [];
    public function mount()
    {
        $this->cart = Cart::where("user_id", Auth::id())->with("course")->get();
    }
    public function carts(Request $request)
    {
        $userId = Auth::id();
        $courseId = $request->input("course_id");
        $exists = Cart::where("user_id", $userId)
            ->where("course_id", $courseId)
            ->exists();
        if (!$exists) {
            Cart::create([
                "user_id" => $userId,
                "course_id" => $courseId,
            ]);
            return response()->json([
                "success" => true,
                "message" => "Item berhasil ditambahkan ke keranjang!",
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Item sudah ada di keranjang!",
            ]);
        }
    }

    public function removeFromCart($id)
    {
        $userId = Auth::id();

        // Cari item di keranjang berdasarkan id
        $cartItem = Cart::where("user_id", $userId)->where("id", $id)->first();

        if ($cartItem) {
            // Hapus item dari keranjang
            $cartItem->delete();

            return response()->json(["success" => "Item removed from cart"]);
        }

        return response()->json(["error" => "Item not found in cart"], 404);
    }

    // Payment
    public function payment(Request $request)
    {
        $rand = Str::random(6);
        $user = auth()->user();
        $cartItems = Cart::where("user_id", $user->id)->get();
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->course->harga;
        });

        $transaction = [
            "transaction_details" => [
                "order_id" => $rand,
                "gross_amount" => $totalAmount,
            ],
            "customer_details" => [
                "first_name" => $user->name,
                "email" => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($transaction);
        $payment = Payment::create([
            "trx" => $transaction["transaction_details"]["order_id"],
            "user_id" => $user->id,
            "cart_id" => $cartItems->first()->id,
            "snap_token" => $snapToken,
        ]);

        return response()->json(["token" => $snapToken]);
    }

    public function handleCallback(Request $request)
    {
        $serverKey = config("services.midtrans.serverKey");
        $payment = Payment::where("trx", $request->order_id)->first();
        $notif = new \Midtrans\Notification();
        $hashed = hash(
            "sha512",
            $notif->order_id .
                $notif->status_code .
                $notif->gross_amount .
                $serverKey
        );

        if ($hashed == $request->signature_key) {
            if ($payment) {
                if (
                    $notif->transaction_status == "capture" ||
                    $notif->transaction_status == "settlement"
                ) {
                    $payment->update(["status" => "Paid"]);
                    if ($payment->status == "Paid") {
                        Cart::where("user_id", $payment->user_id)->delete();
                    }
                } elseif (
                    in_array($request->transaction_status, [
                        "cancel",
                        "deny",
                        "expire",
                    ])
                ) {
                    $payment->update(["status" => "Unpaid"]);
                }
            }
        }
    }

    public function showCourseUser()
    {
        $user = auth()->user();
        $courses = Cart::whereHas("payment", function ($query) {
            $query->where("status", "Paid");
        })
            ->where("user_id", $user->id)
            ->with("course")
            ->get()
            ->pluck("course");

        return view("pages.client.kursus.index", compact("courses"));
    }

    public function showDetailCourseUser($name)
    {
        $user = auth()->user();

        // Ambil kursus berdasarkan nama, termasuk subcourses
        $course = Cart::whereHas("payment", function ($query) {
            $query->where("status", "Paid");
        })
            ->where("user_id", $user->id)
            ->whereHas("course", function ($query) use ($name) {
                $query->where("nama", $name); // Ganti 'id' dengan 'nama'
            })
            ->with("course.subCourses") // Eager load subCourses
            ->first(); // Ganti firstOrFail() dengan first() untuk menghindari exception

        // Cek jika data kursus ditemukan
        if (!$course) {
            abort(404, "Course not found");
        }

        $course = $course->course;

        return view("pages.client.kursus.detail", compact("course"));
    }
}
