@extends('layouts.app')

@section('title', 'Road Care - Home')

@section('content')
<div class="px-5 pb-28">
    <!-- Stats Cards -->
    <div class="grid grid-cols-3 gap-3 mt-5">
        <div class="bg-white border border-gray-200 rounded-2xl p-4">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $laporans->count() }}</div>
            <div class="text-xs text-gray-500 font-semibold">TOTAL</div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-4">
            <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mb-2">
                <div class="flex gap-0.5">
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $laporans->where('status', 'in_progress')->count() }}</div>
            <div class="text-xs text-gray-500 font-semibold">PROSES</div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-4">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mb-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-800">{{ $laporans->where('status', 'resolved')->count() }}</div>
            <div class="text-xs text-gray-500 font-semibold">SELESAI</div>
        </div>
    </div>

    <!-- Laporan Terbaru Section -->
    <div class="mt-7">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Laporan Terbaru</h3>
            <a href="#" class="text-blue-500 text-sm font-semibold">Lihat Semua</a>
        </div>

        <div class="space-y-3">
            @forelse($laporans as $laporan)
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="flex-shrink-0">
                        @if($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-20 h-20 rounded-xl object-cover">
                        @else
                            <div class="w-20 h-20 rounded-xl bg-gray-200 flex items-center justify-center">
                                <span class="text-2xl">🛣️</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-gray-800 text-sm truncate">
                            {{ $laporan->alamat ?? 'Jalan Tidak Diketahui' }}
                        </h4>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">
                            {{ ucfirst(str_replace('_', ' ', $laporan->kategori)) }}
                        </p>
                        <div class="flex items-center gap-1 mt-1.5">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs text-gray-400">
                                {{ $laporan->created_at->format('l, d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        @if($laporan->status === 'pending')
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-semibold">Terkirim</span>
                        @elseif($laporan->status === 'in_progress')
                            <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-semibold">Proses</span>
                        @elseif($laporan->status === 'resolved')
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">Selesai</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">{{ ucfirst($laporan->status) }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-6xl mb-3">📋</div>
                    <h3 class="font-bold text-gray-800 mb-2">Belum Ada Laporan</h3>
                    <p class="text-sm text-gray-500 mb-4">Jadilah yang pertama melaporkan!</p>
                    <a href="{{ route('laporan.create') }}" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-xl font-semibold">
                        + Tambah Laporan
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
