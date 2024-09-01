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
        $course = Course::find($courseId);

        // Check if item is already in the cart
        if (
            !Cart::where("user_id", $userId)
                ->where("course_id", $courseId)
                ->exists()
        ) {
            Cart::create([
                "user_id" => $userId,
                "course_id" => $courseId,
            ]);

            return response()->json();
        }
        return response()->json();
    }
}
