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

            <div class="mt-6 flex gap-3 flex-wrap">
                <a href="{{ route('laporan.create') }}"
                   class="bg-white text-blue-700 px-5 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition transform">
                    ➕ Buat Laporan
                </a>

                <a href="{{ route('map') }}"
                   class="border-2 border-white px-5 py-3 rounded-xl text-white font-bold hover:bg-white hover:text-blue-700 transition">
                    🗺 Peta
                </a>
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

<!-- ================= STATISTIK ================= -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5 mt-6 sm:mt-8">
    <!-- Total -->
    <div class="bg-white rounded-3xl p-4 sm:p-6 shadow-sm border hover:-translate-y-1 hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 rounded-2xl p-4 text-3xl flex-shrink-0">

            </div>
            <div>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
                    {{ $totalBeranda ?? 0 }}
                </h3>
                <p class="text-xs sm:text-sm font-bold text-gray-400 uppercase tracking-wide">
                    Total Laporan
                </p>
            </div>
        </div>
    </div>

    <!-- Proses -->
    <div class="bg-white rounded-3xl p-4 sm:p-6 shadow-sm border hover:-translate-y-1 hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-4">
            <div class="bg-orange-100 rounded-2xl p-4 text-3xl flex-shrink-0">
                💬
            </div>
            <div>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
                    {{ $prosesBeranda ?? 0 }}
                </h3>
                <p class="text-xs sm:text-sm font-bold text-gray-400 uppercase tracking-wide">
                    Dalam Proses
                </p>
            </div>
        </div>
    </div>

    <!-- Selesai -->
    <div class="bg-white rounded-3xl p-4 sm:p-6 shadow-sm border hover:-translate-y-1 hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-4">
            <div class="bg-green-100 rounded-2xl p-4 text-3xl flex-shrink-0">
                ✅
            </div>
            <div>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-gray-800">
                    {{ $selesaiBeranda ?? 0 }}
                </h3>
                <p class="text-xs sm:text-sm font-bold text-gray-400 uppercase tracking-wide">
                    Selesai
                </p>
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
