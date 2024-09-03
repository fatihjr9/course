<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $data = User::where("role", 1)->get();
        return view("pages.admin.user");
    }
}
