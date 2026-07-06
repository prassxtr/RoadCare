<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Laporan::count();

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
    }
}