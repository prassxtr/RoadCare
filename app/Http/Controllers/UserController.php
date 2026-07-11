<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\User;

=======
>>>>>>> origin/UI-Admin-dan-pengguna
class UserController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $users = User::latest()->get();
        return view('Admin.user.index', compact('users'));  // ✅ Pakai Admin.user.index
=======
        return view('user.index');
>>>>>>> origin/UI-Admin-dan-pengguna
    }
}