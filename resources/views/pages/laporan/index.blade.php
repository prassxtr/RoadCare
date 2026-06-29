@extends('layouts.app')

@section('title', 'Laporan Saya - Road Care')

@section('content')
<div class="px-5 pb-28">
    <!-- Header -->
    <div class="mt-5">
        <h2 class="text-2xl font-bold text-gray-800">Laporan Saya</h2>
        <p class="text-sm text-gray-500 mt-1">Riwayat laporan yang Anda kirim</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-3 mt-5">
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4">
            <div class="text-2xl font-bold text-blue-600">12</div>
            <div class="text-xs text-blue-700 font-semibold">TOTAL</div>
        </div>
        <div class="bg-orange-50 border border-orange-200 rounded-2xl p-4">
            <div class="text-2xl font-bold text-orange-600">4</div>
            <div class="text-xs text-orange-700 font-semibold">PROSES</div>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-2xl p-4">
            <div class="text-2xl font-bold text-green-600">8</div>
            <div class="text-xs text-green-700 font-semibold">SELESAI</div>
        </div>
    </div>

    <!-- Filter -->
    <div class="mt-5 flex gap-2 overflow-x-auto pb-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold whitespace-nowrap">
            Semua
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap">
            Pending
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap">
            Proses
        </button>
        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap">
            Selesai
        </button>
    </div>

    <!-- List Laporan -->
    <div class="mt-4 space-y-3">
        @for($i = 0; $i < 5; $i++)
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
            <div class="flex gap-3">
                <div class="w-20 h-20 rounded-xl bg-gray-200 flex-shrink-0 flex items-center justify-center">
                    <span class="text-3xl">🛣️</span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="font-bold text-gray-800 text-sm">Jl. Ahmad Yani 2</h4>
                        <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">Selesai</span>
                    </div>
                    <p class="text-xs text-gray-500 mb-2">Aspal Mengelupas</p>
                    <div class="flex items-center gap-3 text-xs text-gray-400">
                        <span>📅 5 Jan 2026</span>
                        <span>🕐 14:30</span>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
