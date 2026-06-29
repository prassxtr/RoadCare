@php
    $activeMenu = request()->routeIs('home') ? 'home' :
                (request()->routeIs('map') ? 'map' :
                (request()->routeIs('laporan.*') ? 'laporan' : 'profil'));
@endphp

<!-- Container Utama Floating -->
<div class="fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[92%] max-w-[420px]">

    <!-- Floating Bar -->
    <nav class="bg-white rounded-full shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-gray-100 px-2 py-3 flex items-center justify-between relative">

        <!-- 1. HOME -->
        <a href="{{ route('home') }}" class="flex-1 flex items-center justify-center gap-2 py-2.5 px-3 transition-all duration-300 {{ $activeMenu === 'home' ? 'bg-blue-50 text-blue-600 rounded-full' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            @if($activeMenu === 'home')
                <span class="font-bold text-sm whitespace-nowrap">Home</span>
            @endif
        </a>

        <!-- 2. PETA -->
        <a href="{{ route('map') }}" class="flex-1 flex items-center justify-center py-2.5 px-3 transition-all {{ $activeMenu === 'map' ? 'bg-blue-50 text-blue-600 rounded-full' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
            </svg>
            @if($activeMenu === 'map')
                <span class="font-bold text-sm ml-1">Peta</span>
            @endif
        </a>

        <!-- 3. Spacer untuk tombol tengah -->
        <div class="flex-1 flex items-center justify-center relative">
            <!-- Tombol LAPOR (Center) -->
            <div class="absolute left-1/2 -translate-x-1/2 -top-7">
                <a href="{{ route('laporan.create') }}" class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center shadow-lg border-4 border-white text-white transform transition hover:scale-105 active:scale-95">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- 4. LIST LAPORAN -->
        <a href="{{ route('laporan.index') }}" class="flex-1 flex items-center justify-center py-2.5 px-3 transition-all {{ $activeMenu === 'laporan' ? 'bg-blue-50 text-blue-600 rounded-full' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            @if($activeMenu === 'laporan')
                <span class="font-bold text-sm ml-1">Data</span>
            @endif
        </a>

        <!-- 5. PROFIL -->
        <a href="{{ route('profil') }}" class="flex-1 flex items-center justify-center py-2.5 px-3 transition-all {{ $activeMenu === 'profil' ? 'bg-blue-50 text-blue-600 rounded-full' : 'text-gray-400 hover:text-gray-600' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            @if($activeMenu === 'profil')
                <span class="font-bold text-sm ml-1">Profil</span>
            @endif
        </a>

    </nav>
</div>

<!-- Spacer agar content tidak tertutup -->
<div class="h-24"></div>
