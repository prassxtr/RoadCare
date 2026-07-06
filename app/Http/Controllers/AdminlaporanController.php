<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    // Menampilkan halaman daftar semua laporan di panel admin
    public function index()
    {
        $laporans = Laporan::latest()->get(); 
        
        $totalLaporan = Laporan::count();
        $jalanRusak = Laporan::where('kategori', 'lubang')->orWhere('kategori', 'retak')->count();
        $banjir = Laporan::where('kategori', 'banjir')->count();
        $longsor = Laporan::where('kategori', 'lainnya')->count();

        return view('Admin.laporan.index', compact('laporans', 'totalLaporan', 'jalanRusak', 'banjir', 'longsor'));
    }

    public function create()
    {
        return view('Admin.laporan.create');
    }
}