<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientCourses extends Controller
{
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
}
