<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Road Care')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <nav class="sticky top-0 z-[4000] bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center font-black text-white text-lg">R</div>
                <span class="text-xl font-extrabold text-gray-800 tracking-tight">Road<span class="text-blue-600">Care</span></span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" 
                   class="text-sm font-bold transition-colors duration-200 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
                    Beranda
                </a>

                <a href="{{ route('map') }}" 
                   class="text-sm font-bold transition-colors duration-200 {{ request()->routeIs('map') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
                    Peta
                </a>

                <a href="{{ route('laporan.index') }}" 
                   class="text-sm font-bold transition-colors duration-200 {{ request()->routeIs('laporan.*') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
                    Laporan Saya
                </a>
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-1.5 text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                
                <div class="flex items-center gap-2 border-l pl-4 border-gray-100">
                    <div class="w-8 h-8 bg-gray-200 text-gray-700 rounded-full font-bold text-sm flex items-center justify-center shadow-sm">
                        P
                    </div>
                    <span class="hidden sm:inline text-xs font-bold text-gray-700">Prass</span>
                </div>
            </div>

        </div>
    </nav>

    <main class="max-w-7xl mx-auto">
        @yield('content')
    </main>

    <div class="fixed bottom-0 left-0 right-0 z-[5000] bg-white/95 backdrop-blur-md border-t border-gray-100 md:hidden px-2 py-2 shadow-[0_-4px_25px_rgba(0,0,0,0.05)]">
        <div class="flex justify-around items-center relative">
            
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-400' }}">Beranda</span>
            </a>

            <a href="{{ route('map') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('map') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('map') ? 'text-blue-600' : 'text-gray-400' }}">Peta</span>
            </a>

            <div class="relative -mt-8 flex flex-col items-center justify-center">
                <a href="{{ route('laporan.create') }}" class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-xl shadow-blue-600/30 border-4 border-white hover:scale-105 active:scale-95 transition-transform duration-150">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
                <span class="text-[10px] font-extrabold text-blue-600 mt-1 tracking-wide">Lapor</span>
            </div>

            <a href="{{ route('laporan.index') }}" class="flex flex-col items-center gap-0.5 w-14 group">
                <div class="p-1 rounded-xl transition-all duration-200 {{ request()->routeIs('laporan.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-400 group-hover:text-blue-600' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold tracking-wide {{ request()->routeIs('laporan.*') ? 'text-blue-600' : 'text-gray-400' }}">Laporanku</span>
            </a>

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

    @yield('scripts')
</body>
</html>