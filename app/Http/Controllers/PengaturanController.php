<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return view('Admin.pengaturan.index');  // ✅ Pakai Admin.pengaturan.index
=======
        return view('pengaturan.index');
>>>>>>> origin/UI-Admin-dan-pengguna
=======
        return view('pengaturan.index');
>>>>>>> origin/tampilan-admin
    }

    public function update(Request $request)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        // Tambahkan logika update pengaturan di sini
        return back()->with('success', 'Pengaturan berhasil disimpan!');
=======
        return redirect()->route('pengaturan.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
>>>>>>> origin/UI-Admin-dan-pengguna
=======
        return redirect()->route('pengaturan.index')
            ->with('success', 'Pengaturan berhasil disimpan.');
>>>>>>> origin/tampilan-admin
    }
}