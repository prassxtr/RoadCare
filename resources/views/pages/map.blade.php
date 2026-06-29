@extends('layouts.app') 

@section('title', 'Peta - Road Care')

@section('content')
<div class="px-5 pb-28">
    <!-- Header Peta -->
    <div class="mt-5">
        <h2 class="text-2xl font-bold text-gray-800">Peta Kerusakan Jalan</h2>
        <p class="text-sm text-gray-500 mt-1">Lihat lokasi kerusakan jalan di sekitarmu</p>
    </div>

    <!-- Search & Filter -->
    <div class="mt-4 space-y-3">
        <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" placeholder="Cari lokasi..." class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-12 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Filter Kategori -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold whitespace-nowrap">
                Semua
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap">
                🕳️ Lubang
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap">
                💥 Retak
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap">
                🌊 Banjir
            </button>
        </div>
    </div>

    <!-- Map Container -->
    <div class="mt-4 bg-gray-200 rounded-2xl overflow-hidden border border-gray-300" style="height: 500px;">
        <!-- Placeholder Map - Nanti bisa diganti dengan Leaflet/Google Maps -->
        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-green-50">
            <div class="text-center p-6">
                <div class="text-6xl mb-3">🗺️</div>
                <h3 class="font-bold text-gray-800 mb-2">Peta Interaktif</h3>
                <p class="text-sm text-gray-600 mb-4">Integrasi dengan Leaflet.js atau Google Maps API</p>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 justify-center">
                        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        <span class="text-gray-600">Laporan Baru</span>
                    </div>
                    <div class="flex items-center gap-2 justify-center">
                        <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                        <span class="text-gray-600">Sedang Diproses</span>
                    </div>
                    <div class="flex items-center gap-2 justify-center">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="text-gray-600">Selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="mt-4 grid grid-cols-2 gap-3">
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <div class="text-2xl font-bold text-blue-600">12</div>
            <div class="text-xs text-gray-500">Laporan di Area Ini</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <div class="text-2xl font-bold text-green-600">5</div>
            <div class="text-xs text-gray-500">Sudah Selesai</div>
        </div>
    </div>
</div>
@endsection
