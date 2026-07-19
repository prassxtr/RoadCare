<header class="fixed top-0 left-0 right-0 h-16 bg-white/90 backdrop-blur-md border-b border-slate-200 z-40 flex items-center justify-between px-4 md:px-6">

    <!-- Kiri: Tombol Mobile & Logo -->
    <div class="flex items-center gap-4">
        <!-- Tombol Hamburger (Hanya muncul di Mobile) -->
        <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center font-black text-white text-lg">R</div>
            <span class="text-lg font-bold text-slate-800 tracking-tight">Road<span class="text-blue-600">Care</span> <span class="text-[10px] font-semibold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full uppercase tracking-wider">{{ Auth::user()->role ?? 'Admin' }}</span></span>
        </div each="flex items-center gap-2">
    </div>

    <!-- Kanan: Profil User -->
    <div class="flex items-center gap-3">
        <div class="hidden sm:flex flex-col items-end mr-2">
            <span class="text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</span>
        <div class="w-9 h-9 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center font-bold text-sm border border-blue-200 shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>

</header>
