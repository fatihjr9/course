<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == "1") {
                return redirect()->route("dashboard-user");
            } else {
                return redirect()->route("dashboard-admin");
            }
        } else {
            // Redirect to login page if the user is not authenticated
            return redirect("/login");
        }
    }
}
