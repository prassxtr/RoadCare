<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-200 shadow-[0_-4px_25px_rgba(0,0,0,0.05)] z-50 pb-safe">
    <div class="max-w-lg mx-auto px-2">
        <div class="flex justify-around items-center h-16">

            <!-- Beranda -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-400' }}">Beranda</span>
            </a>

            <!-- Peta -->
            <a href="{{ route('map') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('map') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('map') ? 'text-blue-600' : 'text-gray-400' }}">Peta</span>
            </a>

            <!-- Tombol Lapor (Tengah) -->
            <div class="relative -mt-8 flex flex-col items-center justify-center">
                <a href="{{ route('laporan.create') }}" class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-xl shadow-blue-600/30 border-4 border-white hover:scale-105 active:scale-95 transition-transform duration-150">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
                <span class="text-[10px] font-extrabold text-blue-600 mt-1 tracking-wide">Lapor</span>
            </div>

            <!-- Laporanku -->
            <a href="{{ route('laporan.index') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('laporan.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('laporan.*') ? 'text-blue-600' : 'text-gray-400' }}">Laporanku</span>
            </a>

            <!-- Profil -->
            <a href="{{ route('profil') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('profil') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('profil') ? 'text-blue-600' : 'text-gray-400' }}">Profil</span>
            </a>

        </div>
    </div>
</nav>

<style>
.pb-safe {
    padding-bottom: env(safe-area-inset-bottom, 0px);
}
</style>
