<header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 sticky top-0 z-10 shadow-sm">
    <div class="flex items-center gap-4">
        <h1 class="text-xl font-bold text-slate-800 tracking-tight">RoadCare Admin</h1>
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-semibold">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <span class="text-sm font-medium text-slate-700">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
    </div>
</header>