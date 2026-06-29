<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RoadCare - {{ $title ?? 'Dashboard' }}</title>

    <!-- Vite CSS & JS (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- ========================================== -->
    <!-- DESKTOP NAVBAR (Hanya muncul di layar md ke atas) -->
    <!-- ========================================== -->
    <nav class="hidden md:flex fixed top-0 left-0 right-0 h-16 bg-white border-b border-gray-200 z-50 items-center justify-between px-6 lg:px-12">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">R</div>
            <span class="text-xl font-bold text-gray-900">RoadCare</span>
        </div>

        <!-- Menu Tengah -->
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Beranda</a>
            <a href="{{ route('map') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Peta</a>
            <a href="{{ route('laporan.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Laporan Saya</a>
        </div>

        <!-- Profil Kanan -->
        <div class="flex items-center gap-4">
            <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-full relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <a href="{{ route('profil') }}" class="flex items-center gap-3 pl-4 border-l border-gray-200">
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-medium">P</div>
                <span class="text-sm font-medium text-gray-700">Prass</span>
            </a>
        </div>
    </nav>

    <!-- ========================================== -->
    <!-- MAIN CONTENT AREA -->
    <!-- ========================================== -->
    <main class="min-h-screen pb-20 pt-0 md:pt-20 md:pb-0 max-w-7xl mx-auto px-4 md:px-8">
        @yield('content')
    </main>

    <!-- ========================================== -->
    <!-- MOBILE BOTTOM BAR (Hanya muncul di layar di bawah md / HP) -->
    <!-- ========================================== -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50">
        <div class="flex justify-around items-center h-16">
            <!-- Home -->
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-full h-full text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[10px] font-medium mt-1">Beranda</span>
            </a>

            <!-- Maps -->
            <a href="{{ route('map') }}" class="flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7"></path></svg>
                <span class="text-[10px] font-medium mt-1">Peta</span>
            </a>

            <!-- FAB (Tombol Buat Laporan di Tengah) -->
            <a href="{{ route('laporan.create') }}" class="flex items-center justify-center -mt-6">
                <div class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-600/30 text-white hover:bg-blue-700 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </a>

            <!-- My Reports -->
            <a href="{{ route('laporan.index') }}" class="flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="text-[10px] font-medium mt-1">Laporan</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('profil') }}" class="flex flex-col items-center justify-center w-full h-full text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span class="text-[10px] font-medium mt-1">Profil</span>
            </a>
        </div>
    </nav>

</body>
</html>
