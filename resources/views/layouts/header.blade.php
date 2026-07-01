<header class="bg-white/80 backdrop-blur-md border-b border-slate-200 fixed top-0 left-0 right-0 h-16 flex items-center justify-between px-6 z-30 transition-all">
    
    <!-- Sisi Kiri: Branding & Pencarian -->
    <div class="flex items-center gap-8">
        <div class="flex items-center gap-2.5">
            <!-- Icon/Logo Geometris Kecil -->
            <div class="p-2 bg-blue-600 rounded-xl text-white shadow-md shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.996 2.497c.317.158.69.158 1.006 0z" />
                </svg>
            </div>
            <span class="text-xl font-bold bg-gradient-to-r from-slate-900 to-blue-900 bg-clip-text text-transparent tracking-tight">
                RoadCare<span class="text-blue-600 font-medium text-sm ml-1 px-1.5 py-0.5 bg-blue-50 rounded-md border border-blue-100">Admin</span>
            </span>
        </div>

        <!-- Tombol Search Cepat (Hanya muncul di desktop) -->
        <div class="relative hidden md:block w-64">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                </svg>
            </span>
            <input type="text" placeholder="Cari laporan..." class="w-full pl-9 pr-4 py-1.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
        </div>
    </div>

    <!-- Sisi Kanan: Notifikasi & Profil -->
    <div class="flex items-center gap-4">
        <!-- Tombol Notifikasi -->
        <button class="relative p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-all">
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
        </button>

        <!-- Garis Pembatas -->
        <div class="h-6 w-px bg-slate-200"></div>

        <!-- Profil Pengguna -->
        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="hidden sm:block text-right">
                <p class="text-sm font-semibold text-slate-800 group-hover:text-blue-600 transition-colors">Administrator</p>
                <p class="text-xs text-slate-400">admin@roadcare.id</p>
            </div>
            <!-- Avatar Inisial (Bisa diganti tag <img> jika ada foto) -->
            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center text-sm shadow-sm ring-2 ring-blue-100">
                AD
            </div>
        </div>
    </div>

</header>