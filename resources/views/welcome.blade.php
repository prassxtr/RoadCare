<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Road Care</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hide scrollbar untuk tampilan lebih bersih */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Mobile Container (Max width seperti HP) -->
    <div class="max-w-md mx-auto bg-gray-50 min-h-screen relative shadow-xl">

        <!-- STATUS BAR (Simulasi) -->
        <div class="bg-white px-5 pt-3 pb-1 flex justify-between items-center text-sm font-semibold text-gray-900">
            <span>14.40</span>
            <div class="flex items-center space-x-1">
                <!-- Signal -->
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M2 22h20V2z"/>
                </svg>
                <!-- Wifi -->
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 18c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-4.24-3.26c.39-.39 1.02-.39 1.41 0 .78.78 1.79 1.25 2.83 1.25s2.05-.47 2.83-1.25c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41-1.16 1.16-2.71 1.8-4.24 1.8s-3.08-.64-4.24-1.8c-.39-.39-.39-1.02 0-1.41zm-4.24-4.24c.39-.39 1.02-.39 1.41 0C6.51 12.09 9.14 13 12 13s5.49-.91 7.07-2.5c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41-1.96 1.96-4.57 3.09-7.48 3.09s-5.52-1.13-7.48-3.09c-.39-.39-.39-1.02 0-1.41zM.69 6.27c.39-.39 1.02-.39 1.41 0C4.68 8.85 8.18 10 12 10s7.32-1.15 9.9-3.73c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41-2.97 2.97-6.95 4.32-11.31 4.32S3.66 10.65.69 7.68c-.39-.39-.39-1.02 0-1.41z"/>
                </svg>
                <!-- Battery -->
                <svg class="w-6 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z"/>
                </svg>
            </div>
        </div>

        <!-- HEADER -->
        <header class="bg-white px-5 pt-2 pb-4 flex items-center justify-between">
            <div class="w-8"></div>
            <h1 class="text-xl font-bold text-gray-900">Road Care</h1>
            <button class="relative p-2 rounded-full hover:bg-gray-100 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
            </button>
        </header>

        <!-- SEARCH BAR -->
        <div class="px-5 pb-4">
            <div class="bg-gray-100 rounded-2xl flex items-center px-4 py-3 space-x-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Search" class="bg-transparent text-sm text-gray-700 placeholder-gray-400 outline-none w-full">
            </div>
        </div>

        <!-- GREETING -->
        <div class="px-5 pb-5">
            <h2 class="text-3xl font-bold text-gray-900 flex items-center space-x-2">
                <span>Halo, Prass</span>
                <span class="text-3xl">👋</span>
            </h2>
            <p class="text-gray-500 text-sm mt-1">Pantau dan laporkan kondisi jalan di sekitarmu.</p>
        </div>

        <!-- STATS CARDS -->
        <div class="px-5 pb-6">
            <div class="grid grid-cols-3 gap-3">
                <!-- Total -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">12</span>
                    <span class="text-xs text-gray-500 font-medium mt-0.5">TOTAL</span>
                </div>

                <!-- Proses -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">4</span>
                    <span class="text-xs text-gray-500 font-medium mt-0.5">PROSES</span>
                </div>

                <!-- Selesai -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">4</span>
                    <span class="text-xs text-gray-500 font-medium mt-0.5">SELESAI</span>
                </div>
            </div>
        </div>

        <!-- LAPORAN TERBARU -->
        <div class="px-5 pb-28">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Laporan Terbaru</h3>
                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat Semua</a>
            </div>

            <!-- List Laporan -->
            <div class="space-y-3">

                <!-- Item 1 - Selesai -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center space-x-3">
                    <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?w=200&h=200&fit=crop" alt="Jalan Rusak" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <h4 class="font-bold text-gray-900 text-sm truncate pr-2">JL. Sultan Abdurahman</h4>
                            <span class="flex-shrink-0 px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Selesai</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">Aspal Mengelupas diperbaiki</p>
                        <div class="flex items-center text-xs text-gray-400 mt-1.5">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Kemarin, 16.30
                        </div>
                    </div>
                </div>

                <!-- Item 2 - Proses -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center space-x-3">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=200&h=200&fit=crop" alt="Jalan Rusak" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <h4 class="font-bold text-gray-900 text-sm truncate pr-2">JL. Imam Bonjol</h4>
                            <span class="flex-shrink-0 px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">Proses</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">Lubang Disebelah kiri jalur</p>
                        <div class="flex items-center text-xs text-gray-400 mt-1.5">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Rabu, 05 Januari 2026
                        </div>
                    </div>
                </div>

                <!-- Item 3 - Terkirim -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center space-x-3">
                    <img src="https://images.unsplash.com/photo-1572252009286-268acec5ca0a?w=200&h=200&fit=crop" alt="Jalan Rusak" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <h4 class="font-bold text-gray-900 text-sm truncate pr-2">JL. Malyoboro</h4>
                            <span class="flex-shrink-0 px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Terkirim</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">Jalan Penuh lubang</p>
                        <div class="flex items-center text-xs text-gray-400 mt-1.5">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Senin, 05 Januari 2026
                        </div>
                    </div>
                </div>

                <!-- Item 4 - Selesai -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center space-x-3">
                    <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?w=200&h=200&fit=crop" alt="Jalan Rusak" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <h4 class="font-bold text-gray-900 text-sm truncate pr-2">JL. Ahmad Yani 2</h4>
                            <span class="flex-shrink-0 px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Selesai</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">Aspal Mengelupas diperbaiki</p>
                        <div class="flex items-center text-xs text-gray-400 mt-1.5">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Hari ini, 09.20
                        </div>
                    </div>
                </div>

                <!-- Item 5 - Selesai -->
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex items-center space-x-3">
                    <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?w=200&h=200&fit=crop" alt="Jalan Rusak" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <h4 class="font-bold text-gray-900 text-sm truncate pr-2">JL. Ahmad Yani 2</h4>
                            <span class="flex-shrink-0 px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Selesai</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">Aspal Mengelupas diperbaiki</p>
                        <div class="flex items-center text-xs text-gray-400 mt-1.5">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Hari ini, 09.20
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- FLOATING ACTION BUTTON (Tambah Laporan) -->
        <button class="fixed bottom-24 right-5 md:right-[calc(50%-190px)] bg-blue-600 hover:bg-blue-700 text-white px-5 py-3.5 rounded-full shadow-lg shadow-blue-200 flex items-center space-x-2 active:scale-95 transition z-40">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="font-semibold text-sm">Tambah Laporan</span>
        </button>

        <!-- BOTTOM NAVIGATION -->
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-200 flex justify-around items-center py-2 pb-3 z-50 shadow-[0_-4px_12px_rgba(0,0,0,0.05)]">
            <!-- Home (Active) -->
            <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-blue-50 rounded-full">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-900">Home</span>
            </a>

            <!-- Map -->
            <a href="#" class="flex items-center space-x-2 px-4 py-2">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Map</span>
            </a>

            <!-- Laporan -->
            <a href="#" class="flex items-center space-x-2 px-4 py-2">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Laporan</span>
            </a>

            <!-- Profil -->
            <a href="#" class="flex items-center space-x-2 px-4 py-2">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Profil</span>
            </a>
        </nav>

    </div>

</body>
</html>
