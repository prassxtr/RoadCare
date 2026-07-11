<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Laporan::count();
<<<<<<< HEAD
        $totalLaporan = Laporan::count();
        $totalPending = Laporan::where('status', 'pending')->count();
        $totalProses = Laporan::where('status', 'proses')->count();
        $totalSelesai = Laporan::where('status', 'selesai')->count();
        
        // Hitung berdasarkan kategori
        $jalan = Laporan::where('kategori', 'lubang')->orWhere('kategori', 'retak')->count();
        $totalLubang = Laporan::where('kategori', 'lubang')->count();
        $totalRetak = Laporan::where('kategori', 'retak')->count();
        $totalBanjir = Laporan::where('kategori', 'banjir')->count();
        $totalLongsor = Laporan::where('kategori', 'longsor')->count();

        return view('Admin.dashboard.index', compact(
            'total',
            'totalLaporan',
            'jalan',
            'totalPending',
            'totalProses',
            'totalSelesai',
            'totalLubang',
            'totalRetak',
            'totalBanjir',
            'totalLongsor'
        ));
    }

    public function map()
    {
        $laporans = Laporan::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('Admin.dashboard.map', compact('laporans'));
=======

        $jalan = Laporan::where('kategori','Jalan Rusak')->count();

        $banjir = Laporan::where('kategori','Banjir')->count();

        $longsor = Laporan::where('kategori','Tanah Longsor')->count();

        return view('admin.dashboard.index', compact(
            'total',
            'jalan',
            'banjir',
            'longsor'
        ));
    }

    /**
     * Menampilkan halaman peta khusus admin.
     */
    public function map()
    {
        // Mengambil semua data laporan untuk ditampilkan titik koordinatnya di peta
        $laporan = Laporan::all();

        // Mengarahkan ke file view peta milik admin (misal: resources/views/admin/laporan/index.blade.php atau sesuaikan dengan struktur view Anda)
        return view('admin.laporan.index', compact('laporan'));
>>>>>>> origin/UI-Admin-dan-pengguna
    }
}