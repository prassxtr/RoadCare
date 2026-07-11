<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Laporan::count();
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
    }
}