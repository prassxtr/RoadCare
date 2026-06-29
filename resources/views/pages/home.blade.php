@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="py-6">
        <!-- Header Sapaan -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Halo, Prass 👋</h1>
            <p class="text-gray-500 text-sm">Mari bantu perbaiki jalan di sekitarmu.</p>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-3 gap-3 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 mb-1">Total</p>
                <p class="text-xl font-bold text-gray-900">12</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 mb-1">Proses</p>
                <p class="text-xl font-bold text-blue-600">4</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 mb-1">Selesai</p>
                <p class="text-xl font-bold text-green-600">8</p>
            </div>
        </div>

        <!-- Laporan Terbaru -->
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Laporan Terbaru</h2>
        <div class="space-y-3">
            <!-- Contoh Card Laporan -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                    <img src="https://via.placeholder.com/150" class="w-full h-full object-cover" alt="Kerusakan">
                </div>
                <div class="flex-1">
                    <h3 class="font-medium text-gray-900 text-sm">Jalan Berlubang di Jl. Sudirman</h3>
                    <p class="text-xs text-gray-500 mt-1">2 jam yang lalu • Lubang</p>
                    <span class="inline-block mt-2 px-2 py-0.5 text-[10px] font-medium bg-yellow-100 text-yellow-800 rounded-full">Menunggu Verifikasi</span>
                </div>
            </div>
        </div>
    </div>
@endsection
