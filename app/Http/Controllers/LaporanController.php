<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    // Halaman Peta Interaktif (Mengambil data koordinat asli dari database)
    public function map()
    {
        // Ambil semua laporan yang memiliki data koordinat latitude & longitude
        $laporans = Laporan::whereNotNull('latitude')
                           ->whereNotNull('longitude')
                           ->get();

        // Hitung statistik kilat untuk mengisi Quick Stats di template map kamu
        $totalLaporan = Laporan::count();
        $totalSelesai = Laporan::where('status', 'selesai')->count();

        // DIPERBAIKI: Menyesuaikan dengan path aslimu agar tidak error 'view not found'
        return view('pages.map', compact('laporans', 'totalLaporan', 'totalSelesai'));
    }

    // Home Page / Beranda
    public function home()
    {
        // Menggunakan nama variabel khusus agar tidak bentrok dengan halaman 'Laporan Saya'
        $laporansBeranda = Laporan::latest()->take(10)->get();
        
        // Menghitung statistik khusus yang akan dibaca oleh Berandamu
        $totalBeranda = Laporan::count();
        $prosesBeranda = Laporan::where('status', 'proses')->count();
        $selesaiBeranda = Laporan::where('status', 'selesai')->count();

        return view('pages.home', compact('laporansBeranda', 'totalBeranda', 'prosesBeranda', 'selesaiBeranda'));
    }

    // List Semua Laporan (Halaman Laporan Saya)
     public function index()
    {
        $laporans = Laporan::latest()->paginate(10);

    // Pastikan huruf 'K' dan 'S' menggunakan huruf KAPITAL (CamelCase)
        $totalKhususSaya = Laporan::count();
        $prosesKhususSaya = Laporan::where('status', 'proses')->count();
        $selesaiKhususSaya = Laporan::where('status', 'selesai')->count();

        return view('pages.laporan.index', compact(
            'laporans', 
            'totalKhususSaya', 
            'prosesKhususSaya', 
            'selesaiKhususSaya'
        ));
    }

    // Form Create Laporan (Multi-step)
    public function create()
    {
        return view('pages.laporan.create');
    }

    // Store Laporan (Menyimpan laporan baru ke database)
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'category' => 'required|in:lubang,retak,banjir,lainnya',
            'urgency' => 'required|in:rendah,sedang,tinggi',
            'description' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'photo_data' => 'required|string',
        ]);

        // Decode base64 foto
        $imageData = $request->photo_data;

        // Hapus prefix data:image/...;base64,
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, etc

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return back()->withErrors(['photo' => 'Format gambar tidak valid']);
            }
        }

        $imageData = base64_decode($imageData);

        if ($imageData === false) {
            return back()->withErrors(['photo' => 'Gagal decode gambar']);
        }

        // Generate nama file unik
        $fileName = 'laporan_' . time() . '_' . uniqid() . '.jpg';
        $filePath = 'laporan/' . $fileName;

        // Simpan foto ke storage
        Storage::disk('public')->put($filePath, $imageData);

        // Simpan ke database
        $laporan = Laporan::create([
            'kategori' => $request->category,
            'deskripsi' => $request->description,
            'foto' => $filePath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->address,
            'urgensi' => $request->urgency,
            'status' => 'pending',
            'user_id' => auth()->id() ?? 1, // Default user_id 1 jika belum login
        ]);

        // Redirect dengan success message ke halaman beranda/home
        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim! Nomor referensi: #RD-' . $laporan->id);
    }

    // Show Detail Laporan
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('pages.laporan.show', compact('laporan'));
    }
}