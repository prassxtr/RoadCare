@extends('layouts.app')

@section('title', 'Profil - Road Care')

@section('content')
<div class="px-5 pb-28">
    <!-- Profile Header -->
    <div class="mt-5 text-center">
        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-4xl font-bold shadow-lg">
            P
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Muhammad Syifa Prasetyo</h2>
        <p class="text-sm text-gray-500">prass@example.com</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-3 mt-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold text-blue-600">12</div>
            <div class="text-xs text-gray-500">Total Laporan</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold text-green-600">8</div>
            <div class="text-xs text-gray-500">Selesai</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold text-orange-600">4</div>
            <div class="text-xs text-gray-500">Proses</div>
        </div>
    </div>

    <!-- Menu Items -->
    <div class="mt-6 space-y-3">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-xl">👤</span>
                    </div>
                    <span class="font-medium text-gray-800">Edit Profil</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-xl">🔔</span>
                    </div>
                    <span class="font-medium text-gray-800">Notifikasi</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-xl">🔒</span>
                    </div>
                    <span class="font-medium text-gray-800">Ubah Password</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                        <span class="text-xl">❓</span>
                    </div>
                    <span class="font-medium text-gray-800">Bantuan</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <span class="text-xl">🚪</span>
                    </div>
                    <span class="font-medium text-red-600">Logout</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- App Version -->
    <div class="text-center mt-6 text-xs text-gray-400">
        Road Care v1.0.0
    </div>
</div>
@endsection
