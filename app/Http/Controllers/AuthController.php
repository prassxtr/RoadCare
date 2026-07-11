<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // ==========================================
    // 1. REGISTER USER BARU
    // ==========================================
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan email dan password Anda.');
    }

    // ==========================================
    // 2. LOGIN (ADMIN & USER BIASA)
    // ==========================================
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ==========================================
        // KHUSUS LOGIN ADMIN
        // ==========================================
        if ($request->email === 'admin@roadcare.com') {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            return back()->withErrors(['email' => 'Email atau password Admin salah.'])->withInput();
        }

        // ==========================================
        // LOGIN USER BIASA (CEK PASSWORD)
        // ==========================================
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password salah. Silakan daftar jika belum punya akun.'])->withInput();
    }

    // ==========================================
    // 3. LOGOUT
    // ==========================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}