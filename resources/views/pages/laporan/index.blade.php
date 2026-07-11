@extends('layouts.app')

@section('title', 'Laporan Saya - Road Care')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-[#FAFBFF] px-4 pb-32 pt-6 sm:px-10 sm:pt-12">
    
    <div class="pointer-events-none absolute left-[-10%] top-[-5%] h-[500px] w-[500px] rounded-full bg-indigo-100/40 blur-[120px]"></div>
    <div class="pointer-events-none absolute right-[-5%] top-[10%] h-[400px] w-[400px] rounded-full bg-blue-100/30 blur-[100px]"></div>

    <div class="relative z-10 flex items-center justify-between gap-4 border-b border-gray-100 pb-8">
        <div class="min-w-0">
            <div class="flex items-center gap-2 mb-1">
                <span class="flex h-2 w-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,0.8)]"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-500/80">Personal Archive</span>
            </div>
            <h2 class="truncate text-2xl font-black tracking-tight text-gray-900 sm:text-4xl">Laporan Saya</h2>
        </div>

        <a href="{{ route('laporan.create') }}" class="group inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-[0_10px_25px_-5px_rgba(79,70,229,0.4)] transition-all duration-300 hover:scale-[1.03] hover:bg-indigo-700 active:scale-95 sm:px-6">
            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-white/20 group-hover:rotate-90 transition-transform duration-300">
                <svg class="h-4 w-4 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
            </span>
            <span class="hidden sm:block">Buat Aduan Baru</span>
            <span class="sm:hidden text-xs">Buat</span>
        </a>
    </div>

    <div class="relative z-10 mt-10 grid grid-cols-3 gap-3 sm:gap-6">
        @php
            $stats = [
                ['label' => 'Total', 'val' => $totalKhususSaya ?? 0, 'icon' => '📁', 'color' => 'indigo'],
                ['label' => 'Proses', 'val' => $prosesKhususSaya ?? 0, 'icon' => '⏳', 'color' => 'amber'],
                ['label' => 'Selesai', 'val' => $selesaiKhususSaya ?? 0, 'icon' => '✨', 'color' => 'emerald'],
            ];
        @endphp

        @foreach($stats as $s)
        <div class="group relative overflow-hidden rounded-[2rem] border border-white bg-white/40 p-4 backdrop-blur-xl transition-all duration-500 hover:border-{{ $s['color'] }}-200 hover:bg-white sm:p-7 shadow-[0_15px_40px_-15px_rgba(0,0,0,0.03)]">
            <div class="relative z-10 flex flex-col items-center sm:flex-row sm:justify-between">
                <div>
                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 sm:text-[11px]">{{ $s['label'] }}</p>
                    <h3 class="mt-1 text-2xl font-black text-gray-900 sm:text-4xl">{{ $s['val'] }}</h3>
                </div>
                <div class="mt-2 flex h-10 w-10 items-center justify-center rounded-2xl bg-{{ $s['color'] }}-50 text-{{ $s['color'] }}-500 transition-transform duration-500 group-hover:rotate-12 sm:mt-0 sm:h-14 sm:w-14 sm:text-2xl">
                    {{ $s['icon'] }}
                </div>
            </div>
            <div class="absolute -bottom-4 -right-4 h-16 w-16 rounded-full bg-{{ $s['color'] }}-100/20 blur-2xl transition-all duration-500 group-hover:bg-{{ $s['color'] }}-100/40"></div>
        </div>
        @endforeach
    </div>

    <div class="relative z-10 mt-12">
        @if($laporans->isEmpty())
            <div class="relative flex flex-col items-center justify-center rounded-[3rem] border border-dashed border-gray-200 bg-white/30 py-24 backdrop-blur-md">
                <div class="relative mb-8">
                    <div class="h-24 w-24 rounded-[2rem] bg-gradient-to-tr from-indigo-50 to-white p-6 shadow-inner border border-gray-50 flex items-center justify-center">
                        <span class="text-4xl grayscale opacity-50">📂</span>
                    </div>
                    <span class="absolute -right-2 -top-2 flex h-8 w-8 animate-bounce items-center justify-center rounded-full bg-white text-xs shadow-lg">❓</span>
                </div>
                
                <h4 class="text-xl font-extrabold text-gray-900 tracking-tight">Belum Ada Riwayat Laporan</h4>
                <p class="mt-2 max-w-xs text-center text-xs font-medium leading-relaxed text-gray-400 sm:text-sm">
                    Jangan biarkan jalan rusak meresahkan. Mulai laporkan dan pantau kontribusimu di sini secara otomatis.
                </p>
                
                <a href="{{ route('laporan.create') }}" class="mt-8 rounded-full bg-gray-900 px-8 py-3 text-[11px] font-bold uppercase tracking-widest text-white shadow-xl transition-all hover:scale-105 active:scale-95">
                    Mulai Sekarang
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                @foreach($laporans as $laporan)
                <div class="group relative flex gap-5 rounded-[2.5rem] border border-gray-50 bg-white p-5 shadow-[0_20px_50px_-20px_rgba(0,0,0,0.02)] transition-all duration-500 hover:border-indigo-100 hover:shadow-[0_30px_60px_-20px_rgba(99,102,241,0.08)]">
                    
                    <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-[2rem] border border-gray-100 sm:h-32 sm:w-32">
                        <img src="{{ $laporan->foto ? asset('storage/' . $laporan->foto) : 'https://images.unsplash.com/photo-1515162305285-0293e4767cc2?q=80&w=400' }}" 
                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Visual">
                        <div class="absolute inset-0 bg-indigo-900/10 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                    </div>

                    <div class="flex flex-1 flex-col justify-between py-1 pr-2">
                        <div>
                            <div class="flex items-center justify-between">
                                <h4 class="truncate text-sm font-black tracking-tight text-gray-900 sm:text-base uppercase">📍 {{ $laporan->alamat ?? 'Lokasi Terdaftar' }}</h4>
                                @php
                                    $statusColor = [
                                        'pending' => 'bg-gray-100 text-gray-400',
                                        'proses'  => 'bg-amber-100 text-amber-600',
                                        'selesai' => 'bg-emerald-100 text-emerald-600'
                                    ][$laporan->status] ?? 'bg-gray-100 text-gray-400';
                                @endphp
                                <span class="rounded-lg {{ $statusColor }} px-2 py-1 text-[9px] font-black uppercase tracking-tighter">{{ $laporan->status }}</span>
                            </div>
                            
                            <p class="mt-1 text-[10px] font-bold text-indigo-500 uppercase tracking-widest">{{ $laporan->kategori }}</p>
                            <p class="mt-2 line-clamp-2 text-[11px] leading-relaxed text-gray-400">{{ $laporan->deskripsi ?? 'Aduan infrastruktur jalan wilayah setempat.' }}</p>
                        </div>

                        <div class="mt-4 flex items-center justify-between border-t border-gray-50 pt-3">
                            <span class="flex items-center gap-1 text-[10px] font-bold text-gray-300 italic">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $laporan->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('laporan.show', $laporan->id) }}" class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 transition-all duration-300 hover:bg-indigo-600 hover:text-white group-hover:translate-x-1">
                                <svg class="h-4 w-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $laporans->links() }}
            </div>
        @endif
    </div>
</div>

<div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
    <div class="absolute left-1/4 top-1/3 h-1 w-1 rounded-full bg-indigo-400/20 animate-ping"></div>
    <div class="absolute right-1/3 top-1/4 h-2 w-2 rounded-full bg-blue-300/10 animate-pulse"></div>
</div>
@endsection