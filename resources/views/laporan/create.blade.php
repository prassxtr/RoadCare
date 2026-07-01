@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Laporan Baru</h2>
            <p class="text-sm text-slate-500 mt-1">Masukkan detail insiden atau kerusakan infrastruktur jalan secara akurat.</p>
        </div>
        <a href="{{ route('laporan.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors shadow-sm self-start sm:self-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('laporan.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-4">1. Informasi Pelapor</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Kode Laporan</label>
                    <input type="text" name="kode_laporan" value="{{ old('kode_laporan') }}" placeholder="Contoh: LP-001"
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all @error('kode_laporan') border-red-500 ring-4 ring-red-500/10 @enderror">
                    @error('kode_laporan') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Pelapor</label>
                    <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Nama lengkap"
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all @error('nama_pelapor') border-red-500 ring-4 ring-red-500/10 @enderror">
                    @error('nama_pelapor') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="0812xxxxxxxx"
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all @error('no_hp') border-red-500 ring-4 ring-red-500/10 @enderror">
                    @error('no_hp') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-4">2. Detail Insiden Jalan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori Kejadian</label>
                    <select name="kategori" class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                        <option value="Jalan Rusak">⚠️ Jalan Rusak</option>
                        <option value="Banjir">🌊 Banjir</option>
                        <option value="Tanah Longsor">⛰️ Tanah Longsor</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Lokasi Kejadian</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Nama jalan, kecamatan, atau koordinat"
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all @error('lokasi') border-red-500 ring-4 ring-red-500/10 @enderror">
                    @error('lokasi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi Lengkap Kerusakan</label>
                    <textarea name="deskripsi" rows="4" placeholder="Tulis kronologi atau detail kerusakan secara mendalam di sini..."
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all @error('deskripsi') border-red-500 ring-4 ring-red-500/10 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tingkat Prioritas</label>
                    <select name="prioritas" class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                        <option value="Rendah">🟢 Rendah (Bisa Ditunda)</option>
                        <option value="Sedang">🟡 Sedang (Butuh Perhatian)</option>
                        <option value="Tinggi">🔴 Tinggi (Darurat/Membahayakan)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Status Laporan Awal</label>
                    <select name="status" class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                        <option value="Menunggu Verifikasi">⏳ Menunggu Verifikasi</option>
                        <option value="Sedang Diproses">⚙️ Sedang Diproses</option>
                        <option value="Selesai Ditangani">✅ Selesai Ditangani</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="reset" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                Reset Form
            </button>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-xl shadow-md shadow-blue-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Simpan Laporan
            </button>
        </div>
    </form>
</div>
@endsection