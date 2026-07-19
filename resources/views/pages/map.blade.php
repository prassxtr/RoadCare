@extends('layouts.app')

@section('title', 'Peta - Road Care')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    /* Hilangkan background default Leaflet pada custom icon */
    .custom-pin-marker {
        background: transparent !important;
        border: none !important;
    }
    .custom-pin-marker:hover {
        transform: scale(1.1);
        transition: transform 0.2s ease;
    }
    /* Styling popup agar lebih rapi */
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .leaflet-popup-content {
        margin: 0;
        width: 220px !important;
    }
</style>

<div class="px-4 sm:px-6 pb-28 max-w-7xl mx-auto">
    <div class="mt-5 mb-6">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-800">Peta Kerusakan Jalan</h2>
        <p class="text-sm text-gray-500 mt-1">Pantau lokasi kerusakan jalan secara real-time di sekitarmu</p>
    </div>

    <div class="space-y-4 mb-6">
        <!-- Search Bar -->
        <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchLocation" placeholder="Cari nama jalan atau daerah..."
                   class="w-full bg-white border border-gray-200 rounded-2xl py-3.5 pl-12 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                   onkeypress="handleSearchKeypress(event)">
            <button onclick="searchLocation()"
                    class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>

        <!-- Filter Buttons -->
        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
            <button onclick="filterMarkers('semua')" data-filter="semua" class="filter-btn px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-bold whitespace-nowrap transition-all shadow-md shadow-blue-600/20">
                Semua
            </button>
            <button onclick="filterMarkers('lubang')" data-filter="lubang" class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-bold whitespace-nowrap transition-all hover:bg-gray-50">
                🕳️ Lubang
            </button>
            <button onclick="filterMarkers('retak')" data-filter="retak" class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-bold whitespace-nowrap transition-all hover:bg-gray-50">
                💥 Retak/Rusak
            </button>
            <button onclick="filterMarkers('banjir')" data-filter="banjir" class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-full text-sm font-bold whitespace-nowrap transition-all hover:bg-gray-50">
                🌊 Banjir
            </button>
        </div>
    </div>

    <!-- Map Container -->
    <div class="bg-gray-100 rounded-3xl overflow-hidden border border-gray-200 relative shadow-lg" style="height: 500px;">
        <div id="leafletMap" class="w-full h-full z-10"></div>

        <!-- Legend -->
        <div class="absolute bottom-4 left-4 z-[1000] bg-white/95 backdrop-blur-sm p-3.5 rounded-2xl shadow-lg border border-gray-100 space-y-2 text-xs font-semibold min-w-[140px]">
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
                <span class="text-gray-700">Laporan Baru</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                </span>
                <span class="text-gray-700">Sedang Diproses</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                <span class="text-gray-700">Selesai</span>
            </div>
        </div>
    </div>

    <!-- Stats Info -->
    <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
            <div class="text-2xl font-black text-blue-600">{{ $totalLaporan ?? 0 }}</div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mt-1">Total Laporan</div>
        </div>
        <div class="bg-red-50 border border-red-100 rounded-2xl p-4 shadow-sm">
            <div class="text-2xl font-black text-red-600">{{ $laporans->where('status', 'Menunggu Verifikasi')->count() ?? 0 }}</div>
            <div class="text-xs font-semibold text-red-500 uppercase tracking-wide mt-1">Laporan Baru</div>
        </div>
        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-4 shadow-sm">
            <div class="text-2xl font-black text-orange-600">{{ $laporans->where('status', 'Sedang Diproses')->count() ?? 0 }}</div>
            <div class="text-xs font-semibold text-orange-500 uppercase tracking-wide mt-1">Dalam Proses</div>
        </div>
        <div class="bg-green-50 border border-green-100 rounded-2xl p-4 shadow-sm">
            <div class="text-2xl font-black text-green-600">{{ $totalSelesai ?? 0 }}</div>
            <div class="text-xs font-semibold text-green-500 uppercase tracking-wide mt-1">Sudah Selesai</div>
        </div>
    </div>
</div>

<script>
    let map;
    let markersLayer;
    let markersByCategory = {
        'semua': [],
        'lubang': [],
        'retak': [],
        'banjir': [],
        'lainnya': []
    };
    let searchMarker = null;

    // 1. Fungsi menormalisasi kategori agar filter tidak "ngawur"
    function getFilterCategory(kategori) {
        if (!kategori) return 'lainnya';
        const k = kategori.toLowerCase();

        if (k.includes('lubang')) return 'lubang';
        if (k.includes('retak') || k.includes('rusak')) return 'retak';
        if (k.includes('banjir') || k.includes('genang') || k.includes('air')) return 'banjir';

        return 'lainnya';
    }

    // 2. Fungsi membuat Icon Pin Lokasi yang Proper (bukan lingkaran kosong)
    function getCustomIcon(status) {
        let color = '#ef4444'; // Merah (Laporan Baru)
        let shadowColor = 'rgba(239, 68, 68, 0.4)';

        const s = status.toLowerCase();
        if (s.includes('proses')) {
            color = '#f97316'; // Orange
            shadowColor = 'rgba(249, 115, 22, 0.4)';
        } else if (s.includes('selesai')) {
            color = '#22c55e'; // Hijau
            shadowColor = 'rgba(34, 197, 94, 0.4)';
        }

        return L.divIcon({
            className: 'custom-pin-marker',
            html: `
                <div class="relative flex flex-col items-center">
                    <!-- SVG Pin Marker -->
                    <svg width="32" height="40" viewBox="0 0 32 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="filter: drop-shadow(0 4px 6px ${shadowColor});">
                        <path d="M16 0C7.163 0 0 7.163 0 16C0 27 16 40 16 40C16 40 32 27 32 16C32 7.163 24.837 0 16 0Z" fill="${color}"/>
                        <circle cx="16" cy="15" r="6" fill="white"/>
                    </svg>
                    <!-- Pulse Animation -->
                    <div class="absolute top-3 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full animate-ping opacity-75" style="background-color: ${color};"></div>
                </div>
            `,
            iconSize: [32, 40],
            iconAnchor: [16, 40],
            popupAnchor: [0, -42]
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi peta
        map = L.map('leafletMap', { zoomControl: false });
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap',
            maxZoom: 19
        }).addTo(map);

        markersLayer = L.layerGroup().addTo(map);
        var dataLaporans = @json($laporans ?? []);
        var markersBounds = [];

        // Looping data laporan
        dataLaporans.forEach(function (item) {
            if (item.latitude && item.longitude) {
                const status = item.status || 'Menunggu Verifikasi';

                // Gunakan custom icon pin, BUKAN circleMarker
                var marker = L.marker([item.latitude, item.longitude], {
                    icon: getCustomIcon(status)
                });

                // Normalisasi kategori untuk filter
                var filterCat = getFilterCategory(item.kategori);

                markersLayer.addLayer(marker);
                markersByCategory['semua'].push(marker);

                if (markersByCategory[filterCat]) {
                    markersByCategory[filterCat].push(marker);
                } else {
                    markersByCategory['lainnya'].push(marker);
                }

                markersBounds.push([item.latitude, item.longitude]);

                var gambarUrl = item.foto ? '/storage/' + item.foto : 'https://images.unsplash.com/photo-1515162305285-0293e4767cc2?q=80&w=200';
                var lokasiText = item.lokasi || item.alamat || 'Lokasi tidak tertera';

                // Tentukan warna badge popup
                var badgeColor = status.toLowerCase().includes('selesai') ? '#22c55e' : status.toLowerCase().includes('proses') ? '#f97316' : '#ef4444';

                var infoContent = `
                    <div class="p-3 min-w-[220px]">
                        <img src="${gambarUrl}" class="w-full h-28 object-cover rounded-xl mb-3">
                        <h4 class="font-bold text-sm text-gray-800 mb-1 line-clamp-2">📍 ${lokasiText}</h4>
                        <p class="text-xs font-black text-blue-600 uppercase tracking-wide mb-2">${item.kategori || 'Lainnya'}</p>
                        <p class="text-xs text-gray-600 mb-3 line-clamp-3 leading-relaxed">${item.deskripsi || 'Tidak ada deskripsi tambahan.'}</p>
                        <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold text-white shadow-sm" style="background-color: ${badgeColor}">
                            ${status}
                        </span>
                    </div>
                `;
                marker.bindPopup(infoContent);
            }
        });

        // Auto zoom ke bounds jika ada data
        if (markersBounds.length > 0) {
            map.fitBounds(markersBounds, { padding: [50, 50], maxZoom: 15 });
        } else {
            map.setView([-0.0263, 109.3425], 13); // Default Pontianak
        }
    });

    // ==========================================
    // FUNGSI PENCARIAN LOKASI
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
            alert('Silakan masukkan nama lokasi!');
            return;
        }

        const searchQuery = query + ', Pontianak, Indonesia';

        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        searchInput.placeholder = 'Mencari...';
        searchInput.disabled = true;

        // PENTING: Tambahkan User-Agent agar tidak diblokir (403) oleh Nominatim API
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&limit=1`, {
            headers: { 'User-Agent': 'RoadCareApp/1.0' }
        })
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const result = data[0];
                    const lat = parseFloat(result.lat);
                    const lon = parseFloat(result.lon);

                    map.setView([lat, lon], 16);

                    // Icon khusus untuk hasil pencarian
                    const searchIcon = L.divIcon({
                        className: 'custom-pin-marker',
                        html: `<div class="w-8 h-8 bg-blue-600 rounded-full border-2 border-white shadow-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                               </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -34]
                    });

                    searchMarker = L.marker([lat, lon], { icon: searchIcon })
                        .addTo(map)
                        .bindPopup(`<div class="p-2 font-semibold text-sm text-gray-800">📍 ${result.display_name}</div>`)
                        .openPopup();

                    searchInput.placeholder = 'Cari nama jalan atau daerah...';
                } else {
                    alert('Lokasi tidak ditemukan. Coba kata kunci lain (misal: "Jalan Ahmad Yani").');
                    searchInput.placeholder = 'Cari nama jalan atau daerah...';
                }
                searchInput.disabled = false;
            })
            .catch(error => {
                console.error('Search error:', error);
                alert('Terjadi kesalahan saat mencari lokasi.');
                searchInput.placeholder = 'Cari nama jalan atau daerah...';
                searchInput.disabled = false;
            });
    }

    // ==========================================
    // FUNGSI FILTER MARKER
    // ==========================================
    function filterMarkers(category) {
        // Update tampilan tombol
        document.querySelectorAll('.filter-btn').forEach(btn => {
            if (btn.dataset.filter === category) {
                btn.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                btn.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/20');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/20');
                btn.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
            }
        });

        // Hapus semua marker
        markersLayer.clearLayers();

        // Tampilkan marker sesuai kategori
        if (category === 'semua') {
            // Tampilkan semua marker yang ada
            Object.values(markersByCategory).flat().forEach(function(marker) {
                markersLayer.addLayer(marker);
            });
        } else if (markersByCategory[category]) {
            markersByCategory[category].forEach(function(marker) {
                markersLayer.addLayer(marker);
            });
        }
    }
</script>
@endsection
