<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi input email (password opsional kerana user biasa tidak gunakannya)
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // ==========================================
        // KHUSUS LOGIN ADMIN (Menggunakan Password)
        // ==========================================
        if ($request->email === 'admin@roadcare.com') {
            
            // Pastikan admin memasukkan password
            if (!$request->filled('password')) {
                return back()->withErrors(['email' => 'Sila masukkan password untuk akaun Admin.']);
            }

            // Cuba log masuk menggunakan email dan password
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                // Alihkan terus ke Dashboard Admin
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors(['email' => 'Password Admin salah.'])->withInput();
        }


        // ==========================================
        // LOGIN USER BIASA (Tanpa Password)
        // ==========================================
        $user = User::where('email', $request->email)->first();

        // Jika user belum ada, daftarkan secara automatik
        if (!$user) {
            $user = User::create([
                'name' => 'User_' . rand(1000, 9999),
                'email' => $request->email,
                'password' => bcrypt('user-roadcare-access'), // Formaliti DB
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}