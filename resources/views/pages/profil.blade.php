@extends('layouts.app')

@section('title', 'Profil - Road Care')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8 pb-32">
    
    <!-- Header Profil -->
    <div class="text-center mb-8">
        <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
        <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
        <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-4 text-center border border-gray-100">
            <div class="text-2xl font-bold text-blue-600">{{ Auth::user()->laporans()->count() ?? 0 }}</div>
            <div class="text-xs text-gray-500 mt-1">Total Laporan</div>
        </div>
        <div class="bg-white rounded-2xl p-4 text-center border border-gray-100">
            <div class="text-2xl font-bold text-green-600">{{ Auth::user()->laporans()->where('status', 'selesai')->count() ?? 0 }}</div>
            <div class="text-xs text-gray-500 mt-1">Selesai</div>
        </div>
        <div class="bg-white rounded-2xl p-4 text-center border border-gray-100">
            <div class="text-2xl font-bold text-orange-600">{{ Auth::user()->laporans()->where('status', 'proses')->count() ?? 0 }}</div>
            <div class="text-xs text-gray-500 mt-1">Proses</div>
        </div>
    </div>

    <!-- Menu Profil -->
    <div class="space-y-3">
        <a href="#" class="flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="font-semibold text-gray-900">Edit Profil</span>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="#" class="flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <span class="font-semibold text-gray-900">Notifikasi</span>
            </div>
            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
        </a>

        <a href="#" class="flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <span class="font-semibold text-gray-900">Ubah Password</span>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="block">
            @csrf
            <button type="submit" class="w-full flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 hover:bg-red-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-red-600">Logout</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </form>
    </div>
</div>
@endsection