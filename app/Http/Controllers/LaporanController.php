<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    // Halaman Peta Interaktif User
    public function map()
    {
        $laporans = Laporan::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $totalLaporan = Laporan::count();
        $totalSelesai = Laporan::where('status', 'selesai')->count();

        return view('pages.map', compact('laporans', 'totalLaporan', 'totalSelesai'));
    }

    // Beranda User
    public function home()
    {
        $laporansBeranda = Laporan::latest()->take(10)->get();
        $totalBeranda = Laporan::count();
        $prosesBeranda = Laporan::where('status', 'proses')->count();
        $selesaiBeranda = Laporan::where('status', 'selesai')->count();

        return view('pages.home', compact('laporansBeranda', 'totalBeranda', 'prosesBeranda', 'selesaiBeranda'));
    }

    // List Halaman Laporan Saya (User)
    public function index()
    {
        $laporans = Laporan::latest()->paginate(10);
        $totalKhususSaya = Laporan::count();
        $prosesKhususSaya = Laporan::where('status', 'proses')->count();
        $selesaiKhususSaya = Laporan::where('status', 'selesai')->count();

        return view('pages.laporan.index', compact('laporans', 'totalKhususSaya', 'prosesKhususSaya', 'selesaiKhususSaya'));
    }

    // Form Buat Laporan User
    public function create()
    {
        return view('pages.laporan.create');
    }

    // Simpan Laporan Baru dari User
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:lubang,retak,banjir,lainnya',
            'urgency' => 'required|in:rendah,sedang,tinggi',
            'description' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'photo_data' => 'required|string',
        ]);

        $imageData = $request->photo_data;
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
        }
        $imageData = base64_decode($imageData);

        $fileName = 'laporan_' . time() . '_' . uniqid() . '.jpg';
        $filePath = 'laporan/' . $fileName;
        Storage::disk('public')->put($filePath, $imageData);

        Laporan::create([
            'kategori' => $request->category,
            'deskripsi' => $request->description,
            'foto' => $filePath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->address,
            'urgensi' => $request->urgency,
            'status' => 'pending',
            'user_id' => Auth::id() ?? 1,
        ]);

        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim!');
    }

    // Detail Laporan User
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('pages.laporan.show', compact('laporan'));
    }
}
