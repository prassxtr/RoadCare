@extends('layouts.app')

@section('title', 'Beranda - Road Care')

@section('content')
<div class="px-4 sm:px-5 pb-28 max-w-7xl mx-auto">
    
    <div class="text-center mt-6 sm:mt-10">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Halo, Prass 👋</h2>
        <p class="text-xs sm:text-sm text-gray-500 mt-1.5">Pantau dan laporkan kondisi jalan di sekitarmu.</p>
    </div>

    <div class="grid grid-cols-3 gap-2 sm:gap-4 mt-6 sm:mt-8">
        <div class="bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-3 sm:p-6 shadow-sm flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-5 transition-all hover:shadow-md">
            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-blue-50 text-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-2xl shadow-inner border border-blue-100 flex-shrink-0">
                📄
            </div>
            <div class="min-w-0">
                <div class="text-xl sm:text-3xl font-extrabold text-gray-900 leading-none">{{ $totalBeranda ?? 0 }}</div>
                <div class="text-[9px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider sm:tracking-widest mt-1 truncate">TOTAL</div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-3 sm:p-6 shadow-sm flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-5 transition-all hover:shadow-md">
            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-orange-50 text-orange-600 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-2xl shadow-inner border border-orange-100 flex-shrink-0">
                💬
            </div>
            <div class="min-w-0">
                <div class="text-xl sm:text-3xl font-extrabold text-gray-900 leading-none">{{ $prosesBeranda ?? 4 }}</div>
                <div class="text-[9px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider sm:tracking-widest mt-1 truncate">PROSES</div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-3 sm:p-6 shadow-sm flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-5 transition-all hover:shadow-md">
            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-green-50 text-green-600 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-2xl shadow-inner border border-green-100 flex-shrink-0">
                ✅
            </div>
            <div class="min-w-0">
                <div class="text-xl sm:text-3xl font-extrabold text-gray-900 leading-none">{{ $selesaiBeranda ?? 4 }}</div>
                <div class="text-[9px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider sm:tracking-widest mt-1 truncate">SELESAI</div>
            </div>
        </div>
    </div>

    <div class="mt-6 sm:mt-10 bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-4 sm:p-8 shadow-sm">
        
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <h3 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight">Laporan Terbaru</h3>
            
            <div class="flex items-center gap-3 w-full lg:w-auto">
                <div class="relative flex-grow">
                    <input type="text" placeholder="Search report, street name..." 
                           class="w-full lg:w-80 pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all">
                    <span class="absolute left-3.5 top-3 text-gray-400 text-sm">🔍</span>
                </div>
                
                <a href="{{ route('laporan.create') }}" class="hidden sm:inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-600/20 transition-all whitespace-nowrap active:scale-95">
                    ➕ Tambah Laporan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mt-6 sm:mt-8">
            
            <div class="bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-4 sm:p-5 flex gap-4 sm:gap-5 hover:border-blue-100 transition-colors shadow-sm relative">
                <div class="w-20 h-20 sm:w-28 sm:h-28 bg-gray-100 rounded-xl sm:rounded-2xl overflow-hidden flex-shrink-0 border border-gray-100 shadow-inner">
                    <img src="https://images.unsplash.com/photo-1578319912061-f0330064506c?q=80&w=300" 
                         class="w-full h-full object-cover" alt="Jl. Sultan Abdurahman">
                </div>
                <div class="flex flex-col justify-between flex-grow min-w-0">
                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-950 truncate tracking-tight">JL. Sultan Abdurahman</h4>
                            <span class="text-[9px] sm:text-[10px] font-black uppercase px-2 py-0.5 sm:px-2.5 sm:py-1 bg-green-50 text-green-600 rounded-md whitespace-nowrap tracking-wider">SELESAI</span>
                        </div>
                        <p class="text-[11px] sm:text-xs font-semibold text-blue-600 mt-0.5 sm:mt-1 capitalize">Aspal Mengelupas</p>
                        <p class="text-[10px] sm:text-[11px] text-gray-500 mt-0.5 sm:mt-1 leading-relaxed line-clamp-1">Aspal Mengelupas diperbaiki</p>
                    </div>
                    <div class="text-[10px] sm:text-[11px] font-semibold text-gray-400 mt-2 flex items-center gap-1.5 pt-1.5 sm:pt-2 border-t border-gray-50">
                        🕒 Kemarin, 16.30
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl sm:rounded-3xl p-4 sm:p-5 flex gap-4 sm:gap-5 hover:border-blue-100 transition-colors shadow-sm relative">
                <div class="w-20 h-20 sm:w-28 sm:h-28 bg-gray-100 rounded-xl sm:rounded-2xl overflow-hidden flex-shrink-0 border border-gray-100 shadow-inner flex items-center justify-center text-center p-2">
                    <span class="text-[10px] sm:text-xs font-bold text-gray-400">Road Crack</span>
                </div>
                <div class="flex flex-col justify-between flex-grow min-w-0">
                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <h4 class="text-xs sm:text-sm font-extrabold text-gray-950 truncate tracking-tight">JL. Imam Bonjol</h4>
                            <span class="text-[9px] sm:text-[10px] font-black uppercase px-2 py-0.5 sm:px-2.5 sm:py-1 bg-orange-50 text-orange-600 rounded-md whitespace-nowrap tracking-wider">PROSES</span>
                        </div>
                        <p class="text-[11px] sm:text-xs font-semibold text-blue-600 mt-0.5 sm:mt-1 capitalize">Lubang Jalan</p>
                        <p class="text-[10px] sm:text-[11px] text-gray-500 mt-0.5 sm:mt-1 leading-relaxed line-clamp-1">Lubang Disebelah kiri jalur</p>
                    </div>
                    <div class="text-[10px] sm:text-[11px] font-semibold text-gray-400 mt-2 flex items-center gap-1.5 pt-1.5 sm:pt-2 border-t border-gray-50">
                        🕒 Rabu, 05 Jan 2026
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 sm:mt-10 bg-blue-600 rounded-xl sm:rounded-2xl p-4 sm:p-6 text-white shadow-xl shadow-blue-600/15 flex flex-col justify-center">
            <h4 class="font-bold text-sm sm:text-base tracking-tight">Kontribusi Anda Pekan Ini</h4>
            <p class="text-xs sm:text-sm text-blue-100 mt-1 sm:mt-1.5 opacity-90 leading-relaxed">Laporan Anda telah membantu 1.2k pengendara menghindari bahaya jalan.</p>
        </div>

    </div>

</div>
@endsection