@extends('layouts.app')

@section('title', 'Beranda - Road Care')

@section('content')

<div class="px-4 sm:px-6 pb-28 max-w-7xl mx-auto">


<!-- ================= HERO FOTO JALAN ================= -->

<div class="relative mt-6 overflow-hidden rounded-3xl h-[320px] sm:h-[400px] shadow-xl">


    <img 
        src="{{ asset('images/jalan.jpg') }}"
        alt="Road Care"
        class="absolute inset-0 w-full h-full object-cover"
    >


    <div class="absolute inset-0 bg-gradient-to-r 
    from-blue-950/90 via-blue-800/70 to-transparent">
    </div>



    <div class="relative z-10 h-full flex items-center px-6 sm:px-10">


        <div class="max-w-xl text-white">


            <span class="inline-flex bg-white/20 backdrop-blur 
            px-4 py-2 rounded-full text-xs font-bold">

                🚧 ROAD CARE SYSTEM

            </span>



            <h2 class="mt-5 text-3xl sm:text-5xl font-extrabold">

                Halo, {{ Auth::user()->name }} 👋

            </h2>



            <p class="mt-4 text-sm sm:text-lg text-blue-100">

                Pantau dan laporkan kondisi jalan
                di sekitarmu.

            </p>


            <p class="mt-2 text-sm sm:text-lg font-semibold">

                Bersama menciptakan jalan yang lebih aman
                dan nyaman.

            </p>




            <div class="mt-6 flex gap-3">


                <a href="{{ route('laporan.create') }}"
                class="bg-white text-blue-700 px-5 py-3 rounded-xl 
                font-bold shadow-lg hover:scale-105 transition">

                    ➕ Buat Laporan

                </a>



                <a href="{{ route('map') }}"
                class="border border-white px-5 py-3 rounded-xl
                text-white font-bold hover:bg-white 
                hover:text-blue-700 transition">

                    🗺 Peta

                </a>


            </div>


        </div>


    </div>




    <div class="absolute bottom-5 right-5 hidden sm:block">


        <div class="bg-white/90 backdrop-blur rounded-2xl 
        px-5 py-3 shadow-lg">


            <p class="font-bold text-gray-800">

                ☀️ 28°C Cerah

            </p>


            <p class="text-xs text-gray-500">

                📍 Pontianak, Kalimantan Barat

            </p>


        </div>


    </div>


</div>





<!-- ================= STATISTIK ================= -->


<div class="grid grid-cols-3 gap-2 sm:gap-5 mt-6 sm:mt-8">


    <div class="bg-white rounded-3xl p-3 sm:p-6 shadow-sm 
    border hover:-translate-y-1 hover:shadow-xl transition">


        <div class="flex flex-col sm:flex-row items-center gap-3">


            <div class="bg-blue-100 rounded-2xl p-3 sm:p-4 text-2xl">
                📄
            </div>


            <div class="text-center sm:text-left">


                <h3 class="text-xl sm:text-4xl font-extrabold">
                    {{ $totalBeranda ?? 0 }}
                </h3>


                <p class="text-[10px] sm:text-sm font-bold text-gray-400">
                    TOTAL
                </p>


            </div>


        </div>


    </div>




    <div class="bg-white rounded-3xl p-3 sm:p-6 shadow-sm 
    border hover:-translate-y-1 hover:shadow-xl transition">


        <div class="flex flex-col sm:flex-row items-center gap-3">


            <div class="bg-orange-100 rounded-2xl p-3 sm:p-4 text-2xl">
                💬
            </div>


            <div class="text-center sm:text-left">


                <h3 class="text-xl sm:text-4xl font-extrabold">
                    {{ $prosesBeranda ?? 0 }}
                </h3>


                <p class="text-[10px] sm:text-sm font-bold text-gray-400">
                    PROSES
                </p>


            </div>


        </div>


    </div>




    <div class="bg-white rounded-3xl p-3 sm:p-6 shadow-sm 
    border hover:-translate-y-1 hover:shadow-xl transition">


        <div class="flex flex-col sm:flex-row items-center gap-3">


            <div class="bg-green-100 rounded-2xl p-3 sm:p-4 text-2xl">
                ✅
            </div>


            <div class="text-center sm:text-left">


                <h3 class="text-xl sm:text-4xl font-extrabold">
                    {{ $selesaiBeranda ?? 0 }}
                </h3>


                <p class="text-[10px] sm:text-sm font-bold text-gray-400">
                    SELESAI
                </p>


            </div>


        </div>


    </div>


</div>






<!-- ================= LAPORAN TERBARU ================= -->


<div class="mt-8 bg-white rounded-3xl p-5 sm:p-8 shadow-sm border">


<div class="flex justify-between items-center">


<h3 class="text-xl sm:text-2xl font-extrabold">

Laporan Terbaru

</h3>



<a href="{{ route('laporan.create') }}"
class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold">

➕ Tambah

</a>


</div>




<div class="grid md:grid-cols-2 gap-5 mt-8">


@forelse($laporansBeranda ?? [] as $laporan)


<div class="rounded-3xl border p-4 flex gap-4 hover:shadow-lg transition">


<div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">


@if($laporan->foto)

<img src="{{ asset('storage/'.$laporan->foto) }}"
class="w-full h-full object-cover">

@else

<div class="flex items-center justify-center h-full text-gray-400 text-xs">
No Image
</div>

@endif


</div>



<div class="flex-1">


<div class="flex justify-between gap-2">


<h4 class="font-bold text-sm truncate">

{{ $laporan->alamat ?? 'Alamat tidak tersedia' }}

</h4>



<span class="text-[10px] px-2 py-1 rounded-full font-bold

@if($laporan->status=='selesai')
bg-green-100 text-green-700

@elseif($laporan->status=='proses')
bg-orange-100 text-orange-700

@else
bg-yellow-100 text-yellow-700
@endif
">

{{ strtoupper($laporan->status) }}

</span>


</div>



<p class="text-blue-600 text-xs mt-1">

{{ ucfirst($laporan->kategori) }}

</p>



<p class="text-xs text-gray-500 mt-2 line-clamp-2">

{{ $laporan->deskripsi ?? 'Tidak ada deskripsi' }}

</p>



<p class="text-xs text-gray-400 mt-3">

🕒 {{ $laporan->created_at->diffForHumans() }}

</p>


</div>


</div>



@empty


<div class="col-span-2 text-center py-16 text-gray-400">


<div class="text-6xl">
📋
</div>


<p class="mt-4 font-bold">
Belum ada laporan
</p>


<p class="text-sm">
Jadilah yang pertama melaporkan jalan rusak.
</p>


</div>


@endforelse


</div>





@if($laporansBeranda->hasPages())

<div class="mt-8 flex justify-center">

{{ $laporansBeranda->links() }}

</div>

@endif




<!-- ================= KONTRIBUSI ================= -->


<div class="mt-8 bg-blue-600 rounded-3xl p-6 text-white">


<h4 class="font-bold text-lg">

🌱 Kontribusi Anda Pekan Ini

</h4>


<p class="text-blue-100 mt-2">

Total {{ $totalBeranda ?? 0 }} laporan telah dikirim melalui sistem RoadCare.

</p>


</div>



</div>


</div>


@endsection