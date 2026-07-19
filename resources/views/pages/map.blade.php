@extends('layouts.app') 

@section('title', 'Peta - Road Care')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="px-5 pb-28">
    <div class="mt-5">
        <h2 class="text-2xl font-bold text-gray-800">Peta Kerusakan Jalan</h2>
        <p class="text-sm text-gray-500 mt-1">Lihat lokasi kerusakan jalan di sekitarmu</p>
    </div>

    <div class="mt-4 space-y-3">
        <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="searchLocation" placeholder="Cari lokasi..." 
                   class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-12 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   onkeypress="handleSearchKeypress(event)">
            <button onclick="searchLocation()" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>

        <!-- Filter Buttons -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <button onclick="filterMarkers('semua')" data-filter="semua" class="filter-btn px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold whitespace-nowrap transition-colors">
                Semua
            </button>
            <button onclick="filterMarkers('lubang')" data-filter="lubang" class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap transition-colors">
                🕳️ Lubang
            </button>
            <button onclick="filterMarkers('retak')" data-filter="retak" class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap transition-colors">
                💥 Retak
            </button>
            <button onclick="filterMarkers('banjir')" data-filter="banjir" class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-semibold whitespace-nowrap transition-colors">
                🌊 Banjir
            </button>
        </div>
    </div>

    <div class="mt-4 bg-gray-50 rounded-2xl overflow-hidden border border-gray-200 relative shadow-sm" style="height: 500px;">
        <div id="leafletMap" class="w-full h-full z-10"></div>

        <div class="absolute bottom-4 left-4 z-[1000] bg-white/95 backdrop-blur-sm p-3 rounded-xl shadow-lg border border-gray-100 space-y-1.5 text-[11px] font-semibold min-w-[130px]">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 bg-red-500 rounded-full inline-block"></span>
                <span class="text-gray-700">Laporan Baru</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 bg-orange-500 rounded-full inline-block"></span>
                <span class="text-gray-700">Sedang Diproses</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 bg-green-500 rounded-full inline-block"></span>
                <span class="text-gray-700">Selesai</span>
            </div>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-3">
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-bold text-blue-600">{{ $totalLaporan ?? 0 }}</div>
            <div class="text-xs text-gray-500">Total Laporan</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
            <div class="text-2xl font-bold text-green-600">{{ $totalSelesai ?? 0 }}</div>
            <div class="text-xs text-gray-500">Sudah Selesai</div>
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

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Inisialisasi peta
        map = L.map('leafletMap');

        // 2. Load tile layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Layer group untuk markers
        markersLayer = L.layerGroup().addTo(map);
        
        // Ambil data dari controller
        var dataLaporans = @json($laporans ?? []);
        var markersBounds = [];

        // 3. Looping data laporan
        dataLaporans.forEach(function (item) {
            if (item.latitude && item.longitude) {
                
                var warnaPin = '#ef4444'; // Merah (Pending)
                if (item.status.toLowerCase() === 'proses') warnaPin = '#f97316'; // Orange
                if (item.status.toLowerCase() === 'selesai') warnaPin = '#22c55e'; // Hijau

                var marker = L.circleMarker([item.latitude, item.longitude], {
                    radius: 9,
                    fillColor: warnaPin,
                    color: '#ffffff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.85
                });

                var kategori = item.kategori ? item.kategori.toLowerCase() : 'lainnya';
                
                markersLayer.addLayer(marker);
                markersByCategory['semua'].push(marker);
                
                if (markersByCategory[kategori]) {
                    markersByCategory[kategori].push(marker);
                } else {
                    markersByCategory['lainnya'].push(marker);
                }

                markersBounds.push([item.latitude, item.longitude]);

                var gambarUrl = item.foto ? '/storage/' + item.foto : 'https://images.unsplash.com/photo-1515162305285-0293e4767cc2?q=80&w=200';
                
                var infoContent = `
                    <div style="font-family: sans-serif; width: 190px; padding: 2px;">
                        <img src="${gambarUrl}" style="width: 100%; height: 95px; object-fit: cover; border-radius: 6px; margin-bottom: 6px;">
                        <h4 style="margin: 0; font-size: 13px; font-weight: bold; color: #111827; line-height: 1.3;">📍 ${item.alamat || 'Nama jalan tidak tertera'}</h4>
                        <p style="margin: 3px 0 2px 0; font-size: 11px; font-weight: 700; color: #2563eb; text-transform: uppercase;">Jenis: ${item.kategori || 'Lainnya'}</p>
                        <p style="margin: 0; font-size: 11px; color: #4b5563; line-height: 1.4;">${item.deskripsi || 'Tidak ada deskripsi tambahan.'}</p>
                        <div style="margin-top: 6px; font-size: 10px; font-weight: bold; color: ${warnaPin}; text-transform: uppercase;">
                            Status: ${item.status}
                        </div>
                    </div>
                `;
                marker.bindPopup(infoContent);
            }
        });

        // 4. Auto zoom ke bounds jika ada data
        if (markersBounds.length > 0) {
            map.fitBounds(markersBounds, { padding: [50, 50] });
        } else {
            map.setView([-0.0263, 109.3425], 13); // Default Pontianak
        }
    });

    // ==========================================
    // FUNGSI PENCARIAN LOKASI
    // ==========================================
    
    // Handle enter key
    function handleSearchKeypress(event) {
        if (event.key === 'Enter') {
            searchLocation();
        }
    }

    // Fungsi search menggunakan Nominatim API
    function searchLocation() {
        const searchInput = document.getElementById('searchLocation');
        const query = searchInput.value.trim();
        
        if (!query) {
            alert('Silakan masukkan nama lokasi!');
            return;
        }

        // Tambahkan "Pontianak" untuk hasil yang lebih relevan
        const searchQuery = query + ', Pontianak, Indonesia';

        // Hapus marker pencarian sebelumnya
        if (searchMarker) {
            map.removeLayer(searchMarker);
        }

        // Show loading (opsional - bisa tambahkan spinner)
        searchInput.placeholder = 'Mencari...';

        // Call Nominatim API
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}&limit=1`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const result = data[0];
                    const lat = parseFloat(result.lat);
                    const lon = parseFloat(result.lon);

                    // Pindahkan peta ke lokasi yang ditemukan
                    map.setView([lat, lon], 16);

                    // Tambahkan marker di lokasi yang dicari
                    searchMarker = L.marker([lat, lon])
                        .addTo(map)
                        .bindPopup(`📍 ${result.display_name}`)
                        .openPopup();

                    // Reset placeholder
                    searchInput.placeholder = 'Cari lokasi...';
                } else {
                    alert('Lokasi tidak ditemukan. Coba kata kunci lain.');
                    searchInput.placeholder = 'Cari lokasi...';
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                alert('Terjadi kesalahan saat mencari lokasi.');
                searchInput.placeholder = 'Cari lokasi...';
            });
    }

    // ==========================================
    // FUNGSI FILTER MARKER
    // ==========================================
    function filterMarkers(category) {
        // Update tampilan tombol
        document.querySelectorAll('.filter-btn').forEach(btn => {
            if (btn.dataset.filter === category) {
                btn.classList.remove('bg-gray-100', 'text-gray-700');
                btn.classList.add('bg-blue-600', 'text-white');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-700');
            }
        });

        // Hapus semua marker
        markersLayer.clearLayers();

        // Tampilkan marker sesuai kategori
        markersByCategory[category].forEach(function(marker) {
            markersLayer.addLayer(marker);
        });
    }
</script>
@endsection