<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\SubCourse;

class SubCourseController extends Controller
{
    public function create($name)
    {
        $course = Course::where("nama", $name)->firstOrFail();
        return view("pages.admin.subcourse.create", compact("course"));
    }

    public function store(Request $request, $name)
    {
        $course = Course::where("nama", $name)->firstOrFail();

        $request->validate([
            "judul" => "required|string|max:255",
            "link" => "required|string|max:255",
        ]);

        SubCourse::create([
            "course_id" => $course->id,
            "judul" => $request->judul,
            "link" => $request->link,
        ]);

        return redirect()->route("course-admin-detail", $course->nama);
    }

    public function edit($name, $id)
    {
        $course = Course::where("nama", $name)->firstOrFail();
        $subCourse = SubCourse::where("id", $id)
            ->where("course_id", $course->id)
            ->firstOrFail();

        return view(
            "pages.admin.subcourse.edit",
            compact("course", "subCourse")
        );
    }

    public function update(Request $request, $name, $id)
    {
        $course = Course::where("nama", $name)->firstOrFail();
        $subCourse = SubCourse::where("id", $id)
            ->where("course_id", $course->id)
            ->firstOrFail();

        $request->validate([
            "judul" => "required|string|max:255",
            "link" => "required|string|max:255",
        ]);

        $subCourse->update([
            "judul" => $request->judul,
            "link" => $request->link,
        ]);

        return redirect()
            ->route("course-admin-detail", $course->nama)
            ->with("success", "Sub-course updated successfully!");
    }

    public function destroy($courseName, $subCourseId)
    {
        $course = Course::where("nama", $courseName)->firstOrFail();
        $subCourse = SubCourse::where("id", $subCourseId)
            ->where("course_id", $course->id)
            ->firstOrFail();

        $subCourse->delete();

        return redirect()
            ->route("course-admin-detail", $course->nama)
            ->with("success", "Sub-course deleted successfully!");
    }
}
