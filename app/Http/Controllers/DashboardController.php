<?php

namespace App\Http\Controllers;

use App\Models\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Laporan::count();

        $jalan = Laporan::where('kategori','Jalan Rusak')->count();

        $banjir = Laporan::where('kategori','Banjir')->count();

        $longsor = Laporan::where('kategori','Tanah Longsor')->count();

        return view('dashboard.index', compact(
            'total',
            'jalan',
            'banjir',
            'longsor'
        ));
    }
}