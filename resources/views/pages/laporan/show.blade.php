@extends('layouts.app')

@section('title', 'Detail Laporan - Road Care')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 pb-32">
    
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Laporan</h1>
            <p class="text-gray-600 mt-2">Informasi lengkap laporan kerusakan jalan</p>
        </div>
        <a href="{{ route('laporan.index') }}" 
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition flex items-center gap-2 text-sm font-medium">
            ← Kembali
        </a>
    </div>

    <!-- Card Detail -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        
        <!-- Foto Laporan -->
        <div class="relative h-64 sm:h-96 bg-gray-100">
            @if($laporan->foto)
                <img src="{{ asset('storage/' . $laporan->foto) }}" 
                     alt="Foto Laporan" 
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm">Tidak ada foto</p>
                    </div>
                </div>
            @endif
            
            <!-- Badge Status -->
            <div class="absolute top-4 right-4">
                <span class="px-4 py-2 rounded-full text-sm font-bold shadow-lg
                    @if($laporan->status == 'pending') bg-yellow-500 text-white
                    @elseif($laporan->status == 'proses') bg-blue-500 text-white
                    @elseif($laporan->status == 'selesai') bg-green-500 text-white
                    @else bg-gray-500 text-white
                    @endif">
                    {{ strtoupper($laporan->status) }}
                </span>
            </div>
        </div>

        <!-- Konten Detail -->
        <div class="p-6 sm:p-8">
            
            <!-- Judul & Lokasi -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $laporan->alamat ?? 'Alamat tidak tersedia' }}</h2>
                <div class="flex items-center gap-2 text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm">
                        @if($laporan->latitude && $laporan->longitude)
                            {{ $laporan->latitude }}, {{ $laporan->longitude }}
                        @else
                            Koordinat tidak tersedia
                        @endif
                    </span>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                
                <!-- Kategori -->
                <div class="bg-blue-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-blue-900">Kategori</span>
                    </div>
                    <p class="text-lg font-bold text-blue-900 capitalize">{{ $laporan->kategori }}</p>
                </div>

                <!-- Urgensi -->
                <div class="bg-orange-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-orange-900">Urgensi</span>
                    </div>
                    <p class="text-lg font-bold text-orange-900 capitalize">{{ $laporan->urgensi }}</p>
                </div>

                <!-- Tanggal Laporan -->
                <div class="bg-purple-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-purple-900">Tanggal Laporan</span>
                    </div>
                    <p class="text-lg font-bold text-purple-900">{{ $laporan->created_at->format('d M Y') }}</p>
                    <p class="text-xs text-purple-600">{{ $laporan->created_at->diffForHumans() }}</p>
                </div>

                <!-- Status -->
                <div class="bg-green-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-green-900">Status</span>
                    </div>
                    <p class="text-lg font-bold text-green-900 capitalize">{{ $laporan->status }}</p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Deskripsi
                </h3>
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $laporan->deskripsi ?? 'Tidak ada deskripsi yang diberikan.' }}
                    </p>
                </div>
            </div>

            <!-- AI Detection Info (jika ada) -->
            @if($laporan->ai_detected_type || $laporan->ai_confidence)
            <div class="mb-6 bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-xl p-4">
                <h3 class="text-lg font-bold text-purple-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    Deteksi AI
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    @if($laporan->ai_detected_type)
                    <div>
                        <p class="text-xs text-purple-600 font-semibold">Jenis Terdeteksi</p>
                        <p class="text-sm font-bold text-purple-900">{{ $laporan->ai_detected_type }}</p>
                    </div>
                    @endif
                    @if($laporan->ai_confidence)
                    <div>
                        <p class="text-xs text-purple-600 font-semibold">Confidence Score</p>
                        <p class="text-sm font-bold text-purple-900">{{ number_format($laporan->ai_confidence * 100, 1) }}%</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('laporan.index') }}" 
                   class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl transition text-center font-semibold">
                    ← Kembali ke Daftar Laporan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection