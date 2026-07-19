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

    <div class="mb-4 grid grid-cols-1 md:grid-cols-[1fr_auto] gap-3">
        <!-- Search Box -->
        <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchLocation" placeholder="Cari wilayah/nama jalan..." 
                   class="w-full bg-white border border-slate-200 rounded-xl py-2.5 pl-12 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   onkeypress="handleSearchKeypress(event)">
            <button onclick="searchLocation()" 
                    class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>

        <!-- Filter Buttons -->
        <div class="flex gap-2 overflow-x-auto pb-1">
            <button onclick="filterMarkers('semua')" data-filter="semua" class="filter-btn px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold whitespace-nowrap transition-colors">
                Semua Kategori
            </button>
            <button onclick="filterMarkers('jalan_rusak')" data-filter="jalan_rusak" class="filter-btn px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium whitespace-nowrap hover:bg-slate-50 transition-colors">
                ⚠️ Jalan Rusak
            </button>
            <button onclick="filterMarkers('banjir')" data-filter="banjir" class="filter-btn px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium whitespace-nowrap hover:bg-slate-50 transition-colors">
                🌊 Banjir
            </button>
            <button onclick="filterMarkers('longsor')" data-filter="longsor" class="filter-btn px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium whitespace-nowrap hover:bg-slate-50 transition-colors">
                ⛰️ Longsor / Lainnya
            </button>
        </div>
    </div>

    <!-- Map Container -->
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

    <!-- Stats -->
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
    // Variabel Global untuk Peta dan Marker
    let map;
    let markersLayer;
    let searchMarker = null;
    
    // Grup marker berdasarkan kategori
    let markersByCategory = {
        'semua': [],
        'jalan_rusak': [], // Akan menampung 'lubang' dan 'retak'
        'banjir': [],
        'longsor': []      // Akan menampung 'longsor' dan 'lainnya'
    };

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Inisialisasi Peta
        map = L.map('leafletMap');

        // 2. Load Tile Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Layer group untuk menampung marker
        markersLayer = L.layerGroup().addTo(map);

        // Ambil data dari controller
        var dataLaporans = @json($laporans ?? []);
        var markersBounds = [];

        // 3. Loop data koordinat
        dataLaporans.forEach(function (item) {
            if (item.latitude && item.longitude) {
                
                // Pewarnaan pin berdasarkan status
                var warnaPin = '#ef4444'; // Merah (Pending/Baru)
                if (item.status && item.status.toLowerCase() === 'proses') warnaPin = '#f97316'; // Orange
                if (item.status && item.status.toLowerCase() === 'selesai') warnaPin = '#22c55e'; // Hijau

                var marker = L.circleMarker([item.latitude, item.longitude], {
                    radius: 9,
                    fillColor: warnaPin,
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.85
                });

                // Masukkan ke layer dan array bounds
                markersLayer.addLayer(marker);
                markersByCategory['semua'].push(marker);
                markersBounds.push([item.latitude, item.longitude]);

                // Kategorikan marker untuk filter
                var kat = (item.kategori || '').toLowerCase();
                if (kat === 'lubang' || kat === 'retak') {
                    markersByCategory['jalan_rusak'].push(marker);
                } else if (kat === 'banjir') {
                    markersByCategory['banjir'].push(marker);
                } else {
                    markersByCategory['longsor'].push(marker); // Fallback untuk longsor/lainnya
                }

                // Pengaturan Gambar Aduan
                var gambarUrl = item.foto ? '/storage/' + item.foto : 'https://images.unsplash.com/photo-1515162305285-0293e4767cc2?q=80&w=200';
                
                // Isi Konten Popup Info Detail
                var infoContent = `
                    <div style="font-family: sans-serif; width: 200px; padding: 2px;">
                        <img src="${gambarUrl}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px; margin-bottom: 6px;">
                        <h4 style="margin: 0; font-size: 13px; font-weight: bold; color: #1e293b; line-height: 1.3;">📍 ${item.alamat || 'Alamat tidak tertera'}</h4>
                        <p style="margin: 4px 0 2px 0; font-size: 11px; font-weight: 700; color: #2563eb; text-transform: uppercase;">Kategori: ${item.kategori || 'Lainnya'}</p>
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

        // 4. Atur auto-center & zoom peta
        if (markersBounds.length > 0) {
            map.fitBounds(markersBounds, { padding: [50, 50] });
        } else {
            map.setView([-0.0263, 109.3425], 13); // Default Pontianak
        }
    });

    // ==========================================
    // FUNGSI PENCARIAN LOKASI (Nominatim API)
    // ==========================================
    function handleSearchKeypress(event) {
        if (event.key === 'Enter') {
            searchLocation();
        }
    }

    function searchLocation() {
        const searchInput = document.getElementById('searchLocation');
        const query = searchInput.value.trim();
        
        if (!query) {
            alert('Silakan masukkan nama lokasi atau jalan!');
            return;
        }

        const searchQuery = query + ', Pontianak, Indonesia'; // Fokus ke area Pontianak

        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        searchInput.placeholder = 'Mencari...';

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&limit=1`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const result = data[0];
                    const lat = parseFloat(result.lat);
                    const lon = parseFloat(result.lon);

                    map.setView([lat, lon], 16);

                    searchMarker = L.marker([lat, lon])
                        .addTo(map)
                        .bindPopup(`📍 ${result.display_name}`)
                        .openPopup();

                    searchInput.placeholder = 'Cari wilayah/nama jalan...';
                } else {
                    alert('Lokasi tidak ditemukan. Coba kata kunci lain (misal: "Jalan Ahmad Yani").');
                    searchInput.placeholder = 'Cari wilayah/nama jalan...';
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                alert('Terjadi kesalahan saat mencari lokasi.');
                searchInput.placeholder = 'Cari wilayah/nama jalan...';
            });
    }

    // ==========================================
    // FUNGSI FILTER MARKER
    // ==========================================
    function filterMarkers(category) {
        // 1. Update tampilan tombol (UI)
        document.querySelectorAll('.filter-btn').forEach(btn => {
            if (btn.dataset.filter === category) {
                btn.classList.remove('bg-white', 'text-slate-700', 'border', 'border-slate-200');
                btn.classList.add('bg-blue-600', 'text-white');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-white', 'text-slate-700', 'border', 'border-slate-200');
            }
        });

        // 2. Hapus semua marker dari peta
        markersLayer.clearLayers();

        // 3. Tampilkan kembali marker sesuai kategori yang dipilih
        markersByCategory[category].forEach(function(marker) {
            markersLayer.addLayer(marker);
        });
    }
</script>
@endsection