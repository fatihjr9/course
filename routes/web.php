<?php
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ClientCourses;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubCourseController;
use Illuminate\Support\Facades\Route;

Route::get("/", [ClientCourses::class, "home"])->name("client-index");
Route::get("/kursus", [ClientCourses::class, "course"])->name("client-course");
Route::get("/kursus/detail/{name}", [ClientCourses::class, "detail"])->name(
    "client-detail"
);

Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::group(["middleware" => "role:0"], function () {
        // Dashboard
        Route::get("/admin/dashboard", function () {
            return view("dashboard");
        })->name("dashboard-admin");
        // Admin Kursus
        Route::get("/admin/pengguna", [
            AdminUserController::class,
            "index",
        ])->name("user-admin-index");
        // Admin Kursus
        Route::get("/admin/kursus", [CourseController::class, "index"])->name(
            "course-admin"
        );
        Route::get("/admin/kursus/tambah", [
            CourseController::class,
            "create",
        ])->name("course-admin-create");

        Route::post("/admin/kursus/tambah", [
            CourseController::class,
            "store",
        ])->name("course-admin-store");

        Route::get("/admin/kursus/edit/{name}", [
            CourseController::class,
            "edit",
        ])->name("course-admin-edit");

        Route::put("/admin/kursus/edit/{name}", [
            CourseController::class,
            "update",
        ])->name("course-admin-update");
        Route::delete("/admin/kursus/{name}", [
            CourseController::class,
            "destroy",
        ])->name("course-admin-destroy");

        Route::get("/admin/kursus/{name}", [
            CourseController::class,
            "detail",
        ])->name("course-admin-detail");
        // Sub course
        Route::get("/admin/kursus/{name}/tambah-materi", [
            SubCourseController::class,
            "create",
        ])->name("subcourse-admin-create");
        Route::post("/admin/kursus/{name}/tambah-materi", [
            SubCourseController::class,
            "store",
        ])->name("subcourse-admin-store");
        Route::get("/admin/kursus/{name}/edit-materi/{id}", [
            SubCourseController::class,
            "edit",
        ])->name("subcourse-admin-edit");

        Route::put("/admin/kursus/{name}/edit-materi/{id}", [
            SubCourseController::class,
            "update",
        ])->name("subcourse-admin-update");

        Route::delete("/admin/kursus/{name}/hapus-materi/{id}", [
            SubCourseController::class,
            "destroy",
        ])->name("subcourse-admin-destroy");
    });

    Route::group(["middleware" => "role:1"], function () {
        Route::get("/user/dashboard", function () {
            return view("dashboard");
        })->name("dashboard-user");
        // Kursus
        Route::get("/user/kursus", [
            ClientCourses::class,
            "showCourseUser",
        ])->name("kursus-user");
        Route::get("/user/kursus/detail/{name}", [
            ClientCourses::class,
            "showDetailCourseUser",
        ])->name("detail-kursus-user");

        // Transaksi
        Route::post("/payment-callback", [
            ClientCourses::class,
            "handleCallback",
        ])->name("client-callback");
        Route::post("/", [ClientCourses::class, "payment"])->name(
            "client-payment"
        );
        Route::post("/add-to-cart", [ClientCourses::class, "carts"])->name(
            "client-add-cart"
        );
        Route::delete("/cart/remove/{id}", [
            ClientCourses::class,
            "removeFromCart",
        ])->name("client-rm-cart");
    });
});

Route::get("/redirects", [HomeController::class, "index"])->middleware("auth");
