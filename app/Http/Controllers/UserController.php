<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\User;

=======
>>>>>>> origin/UI-Admin-dan-pengguna
=======
>>>>>>> origin/tampilan-admin
class UserController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $users = User::latest()->get();
        return view('Admin.user.index', compact('users'));  // ✅ Pakai Admin.user.index
=======
        return view('user.index');
>>>>>>> origin/UI-Admin-dan-pengguna
=======
        return view('user.index');
>>>>>>> origin/tampilan-admin
    }
}