<header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center font-black text-white text-lg">R</div>
                <span class="text-xl font-extrabold text-gray-800 tracking-tight">Road<span class="text-blue-600">Care</span></span>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-sm font-bold transition-colors duration-200 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">Beranda</a>
                <a href="{{ route('map') }}" class="text-sm font-bold transition-colors duration-200 {{ request()->routeIs('map') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">Peta</a>
                <a href="{{ route('laporan.index') }}" class="text-sm font-bold transition-colors duration-200 {{ request()->routeIs('laporan.*') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">Laporan Saya</a>
            </nav>

            <!-- Right Side: User Profile -->
            <div class="hidden md:flex items-center gap-4">
                <!-- Notifikasi -->
                <button class="relative p-1.5 text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <!-- User Dropdown -->
                <div class="relative" id="userDropdown">
                    <button onclick="toggleUserMenu()" class="flex items-center gap-2 hover:bg-gray-100 rounded-full px-2 py-1.5 transition cursor-pointer border-l pl-4 border-gray-100">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full font-bold text-sm flex items-center justify-center shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <span class="text-xs font-bold text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profil Saya
                            </a>
                        </div>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50 transition text-left">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden w-10"></div>
        </div>
    </div>
</header>

<script>
function toggleUserMenu() {
    document.getElementById('userMenu').classList.toggle('hidden');
}


// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const menu = document.getElementById('userMenu');
    if (dropdown && !dropdown.contains(event.target)) {
        menu.classList.add('hidden');
    }
});
</script>
