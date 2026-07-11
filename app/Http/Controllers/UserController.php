<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('Admin.user.index', compact('users'));  // ✅ Pakai Admin.user.index
    }
}