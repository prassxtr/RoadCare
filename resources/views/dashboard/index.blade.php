@extends('layouts.app')

@section('content')
<div class="space-y-8">
    
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Ringkasan</h2>
        <p class="text-sm text-slate-500 mt-1">Pantau statistik data kerusakan infrastruktur jalan secara real-time.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Total Laporan</p>
                    <h1 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $total }}</h1>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 0A48.536 48.536 0 0112 3m0 0c-1.135 0-2.268.03-3.394.09M12 3c1.135 0 2.268.03 3.394.09m-6.788 0A2.25 2.25 0 004.5 5.25v13.5A2.25 2.25 0 006.75 21h6.75" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-xs text-slate-400">Keseluruhan data masuk</div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Jalan Rusak</p>
                    <h1 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $jalan }}</h1>
                </div>
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-xs text-slate-400">Kategori Jalan Rusak</div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Banjir</p>
                    <h1 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $banjir }}</h1>
                </div>
                <div class="p-3 bg-cyan-50 text-cyan-600 rounded-2xl group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.02c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.01a.75.75 0 11-.671-1.34l.041-.01z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-xs text-slate-400">Kategori Luapan Air</div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Longsor</p>
                    <h1 class="text-4xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $longsor }}</h1>
                </div>
                <div class="p-3 bg-rose-50 text-rose-600 rounded-2xl group-hover:bg-rose-600 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-xs text-slate-400">Kategori Tanah Longsor</div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
        <div class="mb-4">
            <h3 class="text-lg font-bold text-slate-800">Visualisasi Data Laporan</h3>
            <p class="text-xs text-slate-400">Perbandingan jumlah laporan berdasarkan kategori insiden.</p>
        </div>
        
        <div class="w-full" style="height: 350px;">
            <canvas id="laporanChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('laporanChart').getContext('2d');
        
        // Membuat Gradien Warna untuk Grafik agar lebih Estetik (Opsional)
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(37, 99, 235, 0.4)'); // Biru pudar atas
        gradient.addColorStop(1, 'rgba(37, 99, 235, 0.0)'); // Transparan bawah

        new Chart(ctx, {
            type: 'bar', // Anda bisa ganti jadi 'line' jika ingin grafik garis
            data: {
                labels: ['Jalan Rusak', 'Banjir', 'Tanah Longsor'], // Sesuai kategori
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: [{{ $jalan }}, {{ $banjir }}, {{ $longsor }}], // Data dari Controller
                    backgroundColor: [
                        'rgba(245, 158, 11, 0.8)',  // Amber untuk Jalan Rusak
                        'rgba(6, 182, 212, 0.8)',   // Cyan untuk Banjir
                        'rgba(225, 29, 72, 0.8)'    // Rose untuk Longsor
                    ],
                    borderColor: [
                        'rgb(245, 158, 11)',
                        'rgb(6, 182, 212)',
                        'rgb(225, 29, 72)'
                    ],
                    borderWidth: 2,
                    borderRadius: 12, // Membuat sudut batang melengkung modern
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan label kotak atas karena sudah jelas
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(241, 245, 249, 1)' // Warna garis latar abu-abu sangat tipis
                        },
                        ticks: {
                            stepSize: 1 // Memastikan skala naik per 1 angka bulat
                        }
                    },
                    x: {
                        grid: {
                            display: false // Hilangkan garis vertikal latar belakang agar bersih
                        }
                    }
                }
            }
        });
    });
</script>
@endsection