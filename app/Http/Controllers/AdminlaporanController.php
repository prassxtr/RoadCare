<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminLaporanController extends Controller
{
    // List semua laporan dengan filter & search
    public function index(Request $request)
    {
        $query = Laporan::with(['user', 'admin']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // Filter berdasarkan urgensi
        if ($request->filled('urgensi')) {
            $query->where('urgensi', $request->urgensi);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search keyword
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
            });
        }

        $laporans = $query->latest()->paginate(10)->withQueryString();

        // Statistik
        $totalLaporan = Laporan::count();
        $totalPending = Laporan::where('status', 'pending')->count();
        $totalProses = Laporan::where('status', 'proses')->count();
        $totalSelesai = Laporan::where('status', 'selesai')->count();

        return view('admin.laporan.index', compact(
            'laporans',
            'totalLaporan',
            'totalPending',
            'totalProses',
            'totalSelesai'
        ));
    }

    // Detail laporan
    public function show($id)
    {
        $laporan = Laporan::with(['user', 'admin'])->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    // Update status & catatan admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
            'catatan_admin' => 'nullable|string|max:1000',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Status laporan berhasil diupdate!');
    }

    // Download foto laporan
    public function download($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan->foto || !Storage::disk('public')->exists($laporan->foto)) {
            return back()->withErrors(['error' => 'File foto tidak ditemukan.']);
        }

        // ✅ FIX: Gunakan response()->download() dengan path lengkap
        $filePath = storage_path('app/public/' . $laporan->foto);
        $fileName = basename($laporan->foto);

        return response()->download($filePath, $fileName);
    }

    // Hapus laporan
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        // Hapus file foto dari storage
        if ($laporan->foto && Storage::disk('public')->exists($laporan->foto)) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}
