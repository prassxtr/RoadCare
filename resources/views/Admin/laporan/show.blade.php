@extends('Admin.layout.app')

@section('page-header')
<div class="mb-6">
    <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-900 mb-3">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="text-sm font-medium">Kembali ke Daftar Laporan</span>
    </a>
    <h1 class="text-3xl font-bold text-slate-900">Detail Laporan #{{ $laporan->id }}</h1>
    <p class="text-slate-500 mt-1">Informasi lengkap laporan kerusakan infrastruktur jalan</p>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Alert Success -->
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Informasi Laporan & Foto -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Informasi Laporan -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Laporan
            </h2>
            
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Kategori:</span>
                    <p class="font-semibold text-slate-900 capitalize">{{ $laporan->kategori }}</p>
                </div>

                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Urgensi:</span>
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                        @if($laporan->urgensi == 'tinggi') bg-red-100 text-red-800 border border-red-200
                        @elseif($laporan->urgensi == 'sedang') bg-yellow-100 text-yellow-800 border border-yellow-200
                        @else bg-green-100 text-green-800 border border-green-200
                        @endif">
                        {{ ucfirst($laporan->urgensi) }}
                    </span>
                </div>

                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Status:</span>
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                        @if($laporan->status == 'selesai') bg-emerald-100 text-emerald-800 border border-emerald-200
                        @elseif($laporan->status == 'proses') bg-orange-100 text-orange-800 border border-orange-200
                        @else bg-yellow-100 text-yellow-800 border border-yellow-200
                        @endif">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>

                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Pelapor:</span>
                    <div>
                        <p class="font-semibold text-slate-900">{{ $laporan->user->name ?? 'Unknown' }}</p>
                        <p class="text-xs text-slate-500">{{ $laporan->user->email ?? '' }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Tanggal Lapor:</span>
                    <p class="font-semibold text-slate-900">{{ $laporan->created_at->format('d M Y H:i') }}</p>
                </div>

                @if($laporan->alamat)
                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Alamat:</span>
                    <p class="font-semibold text-slate-900">{{ $laporan->alamat }}</p>
                </div>
                @endif

                @if($laporan->deskripsi)
                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Deskripsi:</span>
                    <p class="font-semibold text-slate-900">{{ $laporan->deskripsi }}</p>
                </div>
                @endif

                @if($laporan->latitude && $laporan->longitude)
                <div class="flex items-start gap-3">
                    <span class="text-sm text-slate-500 min-w-[120px]">Koordinat:</span>
                    <p class="font-mono text-sm text-slate-900">{{ $laporan->latitude }}, {{ $laporan->longitude }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Foto Laporan -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Foto Laporan
            </h2>
            
            <div class="relative group">
                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" 
                     class="w-full h-64 object-cover rounded-lg border border-slate-200">
                
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                    <a href="{{ asset('storage/' . $laporan->foto) }}" target="_blank" 
                       class="bg-white/90 text-slate-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-white transition">
                        🔍 Lihat Ukuran Penuh
                    </a>
                </div>
            </div>
            
            <div class="mt-4 flex gap-3">
                <a href="{{ route('admin.laporan.download', $laporan->id) }}" 
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg transition text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download Foto
                </a>
            </div>
        </div>
    </div>

    <!-- Catatan Admin (jika ada) -->
    @if($laporan->catatan_admin)
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
        <h3 class="text-sm font-semibold text-blue-900 mb-2 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            Catatan Admin Sebelumnya
        </h3>
        <p class="text-sm text-blue-800">{{ $laporan->catatan_admin }}</p>
    </div>
    @endif

    <!-- Form Update Status -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Update Status Laporan
        </h2>

        <form method="POST" action="{{ route('admin.laporan.updateStatus', $laporan->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                    <select name="status" required 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                        <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>🔧 Proses</option>
                        <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Ditangani Oleh</label>
                    <input type="text" value="{{ $laporan->admin->name ?? 'Belum ditugaskan' }}" 
                           class="w-full px-4 py-2.5 border border-slate-300 rounded-lg bg-slate-50 text-sm" 
                           disabled>
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Catatan Admin</label>
                <textarea name="catatan_admin" rows="4" 
                          class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                          placeholder="Tambahkan catatan untuk laporan ini...">{{ old('catatan_admin', $laporan->catatan_admin) }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Catatan ini akan terlihat oleh pelapor</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-200">
                <button type="submit" 
                        class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg transition text-sm font-semibold shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>

                <button type="button" onclick="confirmDelete()" 
                        class="inline-flex items-center justify-center gap-2 bg-rose-600 hover:bg-rose-700 text-white px-6 py-2.5 rounded-lg transition text-sm font-semibold shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Laporan
                </button>
            </div>
        </form>

        <!-- Form Delete (Hidden) -->
        <form id="delete-form" method="POST" action="{{ route('admin.laporan.destroy', $laporan->id) }}" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

</div>

<script>
function confirmDelete() {
    if (confirm('⚠️ Apakah Anda yakin ingin menghapus laporan ini?\n\nTindakan ini tidak dapat dibatalkan dan foto akan dihapus permanen dari server.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endsection