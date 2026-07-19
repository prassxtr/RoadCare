@extends('Admin.layout.app')

@section('title', 'Peta Sebaran Laporan - Admin')

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
    /* Styling popup agar lebih rapi dan modern */
    .leaflet-popup-content-wrapper {
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .leaflet-popup-content {
        margin: 0;
        width: 240px !important;
    }
    .leaflet-popup-tip {
        background: white;
    }
</style>

<div class="p-4 md:p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Peta Sebaran Laporan</h2>
        <p class="text-sm text-slate-500 mt-1">Pantau lokasi infrastruktur jalan rusak, banjir, dan longsor secara real-time.</p>
    </div>

    <div class="mb-6 grid grid-cols-1 lg:grid-cols-[1fr_auto] gap-4">
        <!-- Search Box -->
        <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchLocation" placeholder="Cari wilayah atau nama jalan..."
                   class="w-full bg-white border border-slate-200 rounded-xl py-3 pl-12 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                   onkeypress="handleSearchKeypress(event)">
            <button onclick="searchLocation()"
                    class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>

        <!-- Filter Buttons -->
        <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-hide">
            <button onclick="filterMarkers('semua')" data-filter="semua" class="filter-btn px-4 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold whitespace-nowrap transition-all shadow-md shadow-blue-600/20">
                Semua
            </button>
            <button onclick="filterMarkers('jalan_rusak')" data-filter="jalan_rusak" class="filter-btn px-4 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold whitespace-nowrap hover:bg-slate-50 transition-all">
                ⚠️ Jalan Rusak
            </button>
            <button onclick="filterMarkers('banjir')" data-filter="banjir" class="filter-btn px-4 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold whitespace-nowrap hover:bg-slate-50 transition-all">
                🌊 Banjir
            </button>
            <button onclick="filterMarkers('longsor')" data-filter="longsor" class="filter-btn px-4 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl text-sm font-bold whitespace-nowrap hover:bg-slate-50 transition-all">
                ⛰️ Longsor / Lainnya
            </button>
        </div>
    </div>

    <!-- Map Container -->
    <div class="bg-slate-100 rounded-2xl overflow-hidden border border-slate-200 relative shadow-lg" style="height: 550px;">
        <div id="leafletMap" class="w-full h-full z-10"></div>

        <!-- Legend -->
        <div class="absolute bottom-4 left-4 z-[1000] bg-white/95 backdrop-blur-sm p-3.5 rounded-xl shadow-md border border-slate-100 space-y-2 text-xs font-semibold min-w-[140px]">
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
                <span class="text-slate-700">Laporan Baru</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                </span>
                <span class="text-slate-700">Sedang Diproses</span>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </span>
                <span class="text-slate-700">Selesai</span>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-black text-blue-600">{{ $totalLaporan ?? 0 }}</div>
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1">Total Laporan Masuk</div>
        </div>
        <div class="bg-red-50 border border-red-100 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-black text-red-600">{{ $laporans->where('status', 'Menunggu Verifikasi')->count() ?? 0 }}</div>
            <div class="text-xs font-semibold text-red-500 uppercase tracking-wider mt-1">Laporan Baru</div>
        </div>
        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-black text-orange-600">{{ $laporans->where('status', 'Sedang Diproses')->count() ?? 0 }}</div>
            <div class="text-xs font-semibold text-orange-500 uppercase tracking-wider mt-1">Dalam Proses</div>
        </div>
        <div class="bg-green-50 border border-green-100 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-black text-green-600">{{ $totalSelesai ?? 0 }}</div>
            <div class="text-xs font-semibold text-green-500 uppercase tracking-wider mt-1">Selesai Ditangani</div>
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
        'jalan_rusak': [],
        'banjir': [],
        'longsor': []
    };

    // 1. Fungsi menormalisasi kategori agar filter tidak "ngawur"
    function getFilterCategory(kategori) {
        if (!kategori) return 'longsor';
        const k = kategori.toLowerCase();

        if (k.includes('lubang') || k.includes('retak') || k.includes('rusak')) return 'jalan_rusak';
        if (k.includes('banjir') || k.includes('genang') || k.includes('air')) return 'banjir';

        return 'longsor'; // Fallback untuk longsor atau kategori lainnya
    }

    // 2. Fungsi membuat Icon Pin Lokasi yang Proper
    function getCustomIcon(status) {
        let color = '#ef4444'; // Merah (Laporan Baru)
        let shadowColor = 'rgba(239, 68, 68, 0.4)';

        const s = status ? status.toLowerCase() : '';
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
        // 1. Inisialisasi Peta
        map = L.map('leafletMap', { zoomControl: false });
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // 2. Load Tile Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Layer group untuk menampung marker
        markersLayer = L.layerGroup().addTo(map);

        // Ambil data dari controller
        var dataLaporans = @json($laporans ?? []);
        var markersBounds = [];

        // 3. Loop data koordinat
        dataLaporans.forEach(function (item) {
            if (item.latitude && item.longitude) {
                const status = item.status || 'Menunggu Verifikasi';

                // Gunakan custom icon pin, BUKAN circleMarker
                var marker = L.marker([item.latitude, item.longitude], {
                    icon: getCustomIcon(status)
                });

                // Masukkan ke layer dan array bounds
                markersLayer.addLayer(marker);
                markersByCategory['semua'].push(marker);
                markersBounds.push([item.latitude, item.longitude]);

                // Kategorikan marker untuk filter menggunakan fungsi yang robust
                var filterCat = getFilterCategory(item.kategori);
                if (markersByCategory[filterCat]) {
                    markersByCategory[filterCat].push(marker);
                }

                // Pengaturan Gambar Aduan
                var gambarUrl = item.foto ? '/storage/' + item.foto : 'https://images.unsplash.com/photo-1515162305285-0293e4767cc2?q=80&w=200';
                var lokasiText = item.lokasi || item.alamat || 'Alamat tidak tertera';

                // Tentukan warna badge popup
                var badgeColor = status.toLowerCase().includes('selesai') ? '#22c55e' : status.toLowerCase().includes('proses') ? '#f97316' : '#ef4444';

                // Isi Konten Popup Info Detail (Menggunakan Tailwind-like inline styles)
                var infoContent = `
                    <div style="padding: 12px; min-width: 220px;">
                        <img src="${gambarUrl}" style="width: 100%; height: 110px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                        <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b; line-height: 1.3; margin-bottom: 4px;">📍 ${lokasiText}</h4>
                        <p style="margin: 0 0 6px 0; font-size: 11px; font-weight: 800; color: #2563eb; text-transform: uppercase; letter-spacing: 0.5px;">${item.kategori || 'Lainnya'}</p>
                        <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.4; margin-bottom: 10px;">${item.deskripsi || 'Tidak ada deskripsi.'}</p>
                        <span style="display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; color: white; background-color: ${badgeColor}; text-transform: uppercase;">
                            ${status}
                        </span>
                    </div>
                `;
                marker.bindPopup(infoContent);
            }
        });

        // 4. Atur auto-center & zoom peta
        if (markersBounds.length > 0) {
            map.fitBounds(markersBounds, { padding: [50, 50], maxZoom: 15 });
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

        const searchQuery = query + ', Pontianak, Indonesia';

        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        searchInput.placeholder = 'Mencari...';
        searchInput.disabled = true;

        // PENTING: Tambahkan User-Agent agar tidak diblokir (403 Forbidden) oleh Nominatim API
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&limit=1`, {
            headers: { 'User-Agent': 'RoadCareAdminApp/1.0' }
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
                        .bindPopup(`<div style="padding: 8px; font-weight: 600; font-size: 13px; color: #1e293b;">📍 ${result.display_name}</div>`)
                        .openPopup();

                    searchInput.placeholder = 'Cari wilayah atau nama jalan...';
                } else {
                    alert('Lokasi tidak ditemukan. Coba kata kunci lain (misal: "Jalan Ahmad Yani").');
                    searchInput.placeholder = 'Cari wilayah atau nama jalan...';
                }
                searchInput.disabled = false;
            })
            .catch(error => {
                console.error('Search error:', error);
                alert('Terjadi kesalahan saat mencari lokasi.');
                searchInput.placeholder = 'Cari wilayah atau nama jalan...';
                searchInput.disabled = false;
            });
    }

    // ==========================================
    // FUNGSI FILTER MARKER
    // ==========================================
    function filterMarkers(category) {
        // 1. Update tampilan tombol (UI)
        document.querySelectorAll('.filter-btn').forEach(btn => {
            if (btn.dataset.filter === category) {
                btn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
                btn.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/20');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'shadow-blue-600/20');
                btn.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            }
        });

        // 2. Hapus semua marker dari peta
        markersLayer.clearLayers();

        // 3. Tampilkan kembali marker sesuai kategori yang dipilih
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
