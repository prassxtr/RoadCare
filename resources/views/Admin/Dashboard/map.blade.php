@extends('admin.layout.app') 

@section('title', 'Peta Sebaran Laporan - Admin')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="px-2">
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-slate-800">Peta Sebaran Laporan</h2>
        <p class="text-sm text-slate-500 mt-1">Pantau lokasi infrastruktur jalan rusak, banjir, dan longsor secara real-time.</p>
    </div>

    <div class="mb-4 grid grid-cols-1 md:flex gap-3">
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchLocation" placeholder="Cari wilayah/nama jalan..." class="w-full bg-white border border-slate-200 rounded-xl py-2.5 pl-12 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex gap-2 overflow-x-auto">
            <button class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold whitespace-nowrap">
                Semua Kategori
            </button>
            <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium whitespace-nowrap hover:bg-slate-50">
                ⚠️ Jalan Rusak
            </button>
            <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium whitespace-nowrap hover:bg-slate-50">
                🌊 Banjir
            </button>
            <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium whitespace-nowrap hover:bg-slate-50">
                ⛰️ Longsor
            </button>
        </div>
    </div>

    <div class="bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 relative shadow-sm" style="height: 550px;">
        <div id="leafletMap" class="w-full h-full z-10"></div>

        <div class="absolute bottom-4 left-4 z-[1000] bg-white/95 backdrop-blur-sm p-3 rounded-xl shadow-md border border-slate-100 space-y-1.5 text-xs font-semibold min-w-[140px]">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-red-500 rounded-full inline-block"></span>
                <span class="text-slate-700">Laporan Baru</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-orange-500 rounded-full inline-block"></span>
                <span class="text-slate-700">Sedang Diproses</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-green-500 rounded-full inline-block"></span>
                <span class="text-slate-700">Selesai</span>
            </div>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-4">
        <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-bold text-blue-600">{{ $totalLaporan ?? 0 }}</div>
            <div class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Laporan Masuk</div>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-bold text-green-600">{{ $totalSelesai ?? 0 }}</div>
            <div class="text-xs font-medium text-slate-500 uppercase tracking-wider">Laporan Selesai Ditangani</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Inisialisasi awal peta Leaflet
        var map = L.map('leafletMap');

        // 2. Load Desain Tile Peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Mengambil data array laporan dari controller Laravel
        var dataLaporans = @json($laporans ?? []);
        var markersBounds = [];

        // 3. Loop data koordinat untuk menampilkan pin marker
        dataLaporans.forEach(function (item) {
            if (item.latitude && item.longitude) {
                
                // Pewarnaan pin berdasarkan status
                var warnaPin = '#ef4444'; // Merah default (Pending / Baru)
                if (item.status && item.status.toLowerCase() === 'proses') warnaPin = '#f97316'; // Orange
                if (item.status && item.status.toLowerCase() === 'selesai') warnaPin = '#22c55e'; // Hijau

                // Gambar lingkaran pin marker di peta
                var marker = L.circleMarker([item.latitude, item.longitude], {
                    radius: 9,
                    fillColor: warnaPin,
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.85
                }).addTo(map);

                markersBounds.push([item.latitude, item.longitude]);

                // Pengaturan Gambar Aduan
                var gambarUrl = item.foto ? '/storage/' + item.foto : 'https://images.unsplash.com/photo-1515162305285-0293e4767cc2?q=80&w=200';
                
                // Isi Konten Popup Info Detail
                var infoContent = `
                    <div style="font-family: sans-serif; width: 200px; padding: 2px;">
                        <img src="${gambarUrl}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px; margin-bottom: 6px;">
                        <h4 style="margin: 0; font-size: 13px; font-weight: bold; color: #1e293b; line-height: 1.3;">📍 ${item.alamat || 'Alamat tidak tertera'}</h4>
                        <p style="margin: 4px 0 2px 0; font-size: 11px; font-weight: 700; color: #2563eb; text-transform: uppercase;">Kategori: ${item.kategori}</p>
                        <p style="margin: 0; font-size: 11px; color: #64748b; line-height: 1.4;">${item.deskripsi || 'Tidak ada deskripsi.'}</p>
                        <hr style="margin: 6px 0; border: 0; border-top: 1px solid #e2e8f0;">
                        <div style="font-size: 10px; font-weight: bold; color: ${warnaPin}; text-transform: uppercase;">
                            Status: ${item.status || 'Pending'}
                        </div>
                    </div>
                `;
                marker.bindPopup(infoContent);
            }
        });

        // 4. Atur auto-center & zoom peta berdasarkan sebaran pin yang ada
        if (markersBounds.length > 0) {
            map.fitBounds(markersBounds, { padding: [50, 50] });
        } else {
            // Default jika data koordinat kosong (Ke arah koordinat Pontianak)
            map.setView([-0.0263, 109.3425], 13);
        }
    });
</script>
@endsection