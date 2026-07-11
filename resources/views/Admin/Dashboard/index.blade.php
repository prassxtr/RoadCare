@extends('Admin.layout.app')

@section('page-header')
<div class="mb-2">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Admin</h2>
    <p class="text-sm text-slate-500 mt-1">Pantau statistik dan laporan infrastruktur jalan secara real-time.</p>
</div>
@endsection

@section('content')
<div class="space-y-6">
    
    {{-- Statistik Utama --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-xs font-semibold text-slate-400 uppercase">Total Laporan</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalLaporan }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-xs font-semibold text-yellow-500 uppercase">Pending</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalPending }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-xs font-semibold text-orange-500 uppercase">Diproses</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalProses }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
            <p class="text-xs font-semibold text-emerald-500 uppercase">Selesai</p>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $totalSelesai }}</p>
        </div>
    </div>

    {{-- Statistik Kategori --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Statistik Berdasarkan Kategori</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-lg border border-slate-100">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Kerusakan Jalan</p>
                    <p class="text-xl font-bold text-slate-800">{{ $jalan }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-lg border border-slate-100">
                <div class="p-3 bg-red-100 text-red-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Lubang</p>
                    <p class="text-xl font-bold text-slate-800">{{ $totalLubang }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-lg border border-slate-100">
                <div class="p-3 bg-cyan-100 text-cyan-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Banjir</p>
                    <p class="text-xl font-bold text-slate-800">{{ $totalBanjir }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-lg border border-slate-100">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Longsor / Lainnya</p>
                    <p class="text-xl font-bold text-slate-800">{{ $totalLongsor }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection