<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::latest()->paginate(5);
        return view("pages.admin.course.index", compact("data"));
    }
    public function create()
    {
        return view("pages.admin.course.create");
    }
    public function detail($name)
    {
        $course = Course::where("nama", $name)->firstOrFail();
        $sc = Course::where("nama", $name)->with("subCourses")->firstOrFail();
        return view("pages.admin.course.detail", compact("course", "sc"));
    }
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|string|max:255",
            "thumbnail" => "required|image|max:2048", // image file, max 2MB
            "harga" => "required|numeric",
            "deskripsi" => "nullable|string",
        ]);

        // Handle the thumbnail upload
        if ($request->hasFile("thumbnail")) {
            $filePath = $request
                ->file("thumbnail")
                ->store("thumbnails", "public");
        }

        Course::create([
            "nama" => $request->nama,
            "thumbnail" => $filePath, // Store the file path in the database
            "harga" => $request->harga,
            "deskripsi" => $request->deskripsi,
        ]);

        return redirect()->route("course-admin");
    }
    public function edit($name)
    {
        $course = Course::where("nama", $name)->firstOrFail();
        return view("pages.admin.course.edit", compact("course"));
    }

    public function update(Request $request, $name)
    {
        $course = Course::where("nama", $name)->firstOrFail();

        $request->validate([
            "nama" => "required|string|max:255",
            "thumbnail" => "nullable|image|max:2048", // Optional thumbnail update
            "harga" => "required|numeric",
            "deskripsi" => "nullable|string",
        ]);

        // Handle the thumbnail upload if a new file is provided
        if ($request->hasFile("thumbnail")) {
            $filePath = $request
                ->file("thumbnail")
                ->store("thumbnails", "public");
            $course->thumbnail = $filePath;
        }

        // Update the course details
        $course->update([
            "nama" => $request->nama,
            "harga" => $request->harga,
            "deskripsi" => $request->deskripsi,
        ]);

        return redirect()
            ->route("course-admin")
            ->with("success", "Course updated successfully!");
    }

    public function destroy($name)
    {
        $course = Course::where("nama", $name)
            ->with("subCourses")
            ->firstOrFail();
        $course->subCourses()->delete();
        $course->delete();
        return redirect()->route("course-admin");
    }
}
