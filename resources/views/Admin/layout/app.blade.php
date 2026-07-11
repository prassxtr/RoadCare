<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RoadCare Admin' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="h-full bg-slate-50 text-slate-800 antialiased flex flex-col">

    {{-- Header Admin --}}
    @include('Admin.layout.header')

    {{-- Main Wrapper --}}
    <div class="flex flex-1 relative">

        {{-- Sidebar Admin --}}
        <aside class="w-64 fixed inset-y-0 left-0 pt-16 bg-white border-r border-slate-200 hidden md:block z-20">
            @include('Admin.layout.sidebar')
        </aside>

        {{-- Content Area --}}
        <div class="flex flex-col flex-1 md:pl-64 min-h-screen">

            <main class="flex-1 p-6 lg:p-8 bg-slate-50">
                @if(View::hasSection('page-header'))
                <div class="mb-6">
                    @yield('page-header')
                </div>
                @endif

                @yield('content')
            </main>

            {{-- Footer Admin --}}
            <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} RoadCare Admin. All rights reserved.
            </footer>

        </div>
    </div>

</body>
</html>
