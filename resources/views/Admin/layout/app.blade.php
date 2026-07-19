<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title ?? 'RoadCare Admin' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="h-full bg-slate-50 text-slate-800 antialiased">

    {{-- Header Admin (Fixed) --}}
    @include('Admin.layout.header')

    {{-- Main Wrapper --}}
    <div class="flex flex-1 relative pt-16"> {{-- pt-16 agar konten tidak tertutup header fixed --}}

        {{-- Sidebar Admin --}}
        @include('Admin.layout.sidebar')

        {{-- Content Area --}}
        <div class="flex flex-col flex-1 md:pl-64 min-h-screen transition-all duration-300">

            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @if(View::hasSection('page-header'))
                    <div class="mb-6">
                        @yield('page-header')
                    </div>
                @endif

                @yield('content')
            </main>

            {{-- Footer Admin --}}
            @include('Admin.layout.footer')

        </div>
    </div>

    {{-- Script untuk Toggle Sidebar Mobile --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // Toggle class untuk animasi slide
            sidebar.classList.toggle('-translate-x-full');

            // Toggle overlay gelap di belakang sidebar
            if (overlay.classList.contains('hidden')) {
                overlay.classList.remove('hidden');
            } else {
                overlay.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
