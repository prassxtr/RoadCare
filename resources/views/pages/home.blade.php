@extends('layouts.app')

@section('title', 'Beranda - Road Care')

@section('content')

<div class="px-4 sm:px-6 pb-28 max-w-7xl mx-auto">

<!-- ================= HERO FOTO JALAN ================= -->
<div class="relative mt-6 overflow-hidden rounded-3xl h-[320px] sm:h-[400px] shadow-xl">
    <img
        src="{{ asset('images/jalan.jpg') }}"
        alt="Road Care"
        class="absolute inset-0 w-full h-full object-cover"
        onerror="this.src='https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=1200&h=600&fit=crop'"
    >

    <div class="absolute inset-0 bg-gradient-to-r from-blue-950/90 via-blue-800/70 to-transparent">
    </div>

    <div class="relative z-10 h-full flex items-center px-6 sm:px-10">
        <div class="max-w-xl text-white">
            <span class="inline-flex bg-white/20 backdrop-blur px-4 py-2 rounded-full text-xs font-bold">
                🚧 ROAD CARE SYSTEM
            </span>

            <h2 class="mt-5 text-3xl sm:text-5xl font-extrabold">
                Halo, {{ Auth::user()->name }} 👋
            </h2>

            <p class="mt-4 text-sm sm:text-lg text-blue-100">
                Pantau dan laporkan kondisi jalan di sekitarmu.
            </p>

            <p class="mt-2 text-sm sm:text-lg font-semibold">
                Bersama menciptakan jalan yang lebih aman dan nyaman.
            </p>

            <!-- BAGIAN YANG DIPERBAIKI: Mengganti tombol redundan dengan info teks minimalis bergaya badge -->
            <div class="mt-6 flex items-center gap-2 text-xs sm:text-sm text-blue-200">
                <span class="flex h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                Gunakan menu di atas atau tombol di bawah untuk mulai mengelola laporan Anda.
            </div>
        </div>
    </div>

    <div class="absolute bottom-5 right-5 hidden sm:block">
        <div class="bg-white/90 backdrop-blur rounded-2xl px-5 py-3 shadow-lg">
            <p class="font-bold text-gray-800">☀️ 28°C Cerah</p>
            <p class="text-xs text-gray-500"> Pontianak, Kalimantan Barat</p>
        </div>
    </div>
</div>

<!-- ================= STATISTIK (DESIGN IMPROVED) ================= -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

    <!-- Total Laporan -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-blue-600/20 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-black text-gray-800">{{ $totalBeranda ?? 0 }}</span>
            </div>
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Laporan</h3>
            <div class="mt-3 flex items-center text-xs text-blue-600 font-semibold">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    Semua waktu
                </span>
            </div>
        </div>
    </div>

    <!-- Dalam Proses -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-400/20 to-orange-600/20 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-black text-gray-800">{{ $prosesBeranda ?? 0 }}</span>
            </div>
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Dalam Proses</h3>
            <div class="mt-3 flex items-center text-xs text-amber-600 font-semibold">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Sedang dikerjakan
                </span>
            </div>
        </div>
    </div>

    <!-- Selesai -->
    <div class="relative overflow-hidden bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-400/20 to-green-600/20 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-4xl font-black text-gray-800">{{ $selesaiBeranda ?? 0 }}</span>
            </div>
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Selesai</h3>
            <div class="mt-3 flex items-center text-xs text-emerald-600 font-semibold">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Berhasil ditangani
                </span>
            </div>
        </div>
    </div>

</div>

<!-- ================= LAPORAN TERBARU ================= -->
<div class="mt-8 bg-white rounded-3xl p-5 sm:p-8 shadow-sm border">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h3 class="text-xl sm:text-2xl font-extrabold text-gray-800">
            Laporan Terbaru
        </h3>

        <a href="{{ route('laporan.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition shadow-lg hover:shadow-xl">
            ➕ Tambah Laporan
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-5 mt-8">
        @forelse($laporansBeranda ?? [] as $laporan)
        <div class="rounded-3xl border border-gray-200 p-4 flex gap-4 hover:shadow-lg transition duration-300 bg-white">
            <!-- Gambar -->
            <div class="w-28 h-28 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
                @if($laporan->foto)
                    <img src="{{ Storage::url($laporan->foto) }}"
                        alt="{{ $laporan->kategori ?? 'Laporan' }}"
                        class="w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/150?text=No+Image'">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Konten -->
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start gap-2">
                    <h4 class="font-bold text-sm text-gray-800 truncate flex-1" title="{{ $laporan->alamat }}">
                        {{ Str::limit($laporan->alamat ?? 'Alamat tidak tersedia', 30) }}
                    </h4>

                    <span class="text-[10px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wide whitespace-nowrap
                        @if($laporan->status=='selesai')
                            bg-green-100 text-green-700
                        @elseif($laporan->status=='proses')
                            bg-orange-100 text-orange-700
                        @else
                            bg-yellow-100 text-yellow-700
                        @endif">
                        {{ $laporan->status ?? 'pending' }}
                    </span>
                </div>

                <p class="text-blue-600 text-xs font-semibold mt-1">
                    {{ ucfirst($laporan->kategori ?? 'Umum') }}
                </p>

                <p class="text-xs text-gray-500 mt-2 line-clamp-2">
                    {{ Str::limit($laporan->deskripsi ?? 'Tidak ada deskripsi', 60) }}
                </p>

                <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $laporan->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-2 text-center py-16 text-gray-400">
            <div class="text-6xl mb-4">📋</div>
            <p class="text-lg font-bold text-gray-600">Belum ada laporan</p>
            <p class="text-sm mt-2">Jadilah yang pertama melaporkan kondisi jalan di area Anda.</p>
            <a href="{{ route('laporan.create') }}"
               class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition">
                Buat Laporan Pertama
            </a>
        </div>
        @endforelse
    </div>

    @if(isset($laporansBeranda) && $laporansBeranda->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $laporansBeranda->links() }}
    </div>
    @endif
</div>

<!-- ================= KONTRIBUSI ================= -->
<div class="mt-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h4 class="font-bold text-lg sm:text-xl flex items-center gap-2">
                <span class="text-2xl">🌱</span>
                Kontribusi Anda Pekan Ini
            </h4>
            <p class="text-blue-100 mt-2 text-sm sm:text-base">
                Total <span class="font-bold text-white">{{ $totalBeranda ?? 0 }}</span> laporan telah dikirim melalui sistem RoadCare.
            </p>
        </div>
        <div class="bg-white/20 backdrop-blur rounded-2xl px-6 py-3">
            <p class="text-2xl font-bold">{{ $totalBeranda ?? 0 }}</p>
            <p class="text-xs text-blue-100">Laporan</p>
        </div>
    </div>
</div>

</div>

@endsection
