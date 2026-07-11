<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('Admin.pengaturan.index');  // ✅ Pakai Admin.pengaturan.index
    }

    public function update(Request $request)
    {
        // Tambahkan logika update pengaturan di sini
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}