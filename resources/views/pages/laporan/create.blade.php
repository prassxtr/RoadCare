@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 pb-32">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Laporan</h1>
        <p class="text-gray-600 mt-2">Laporkan kerusakan jalan di sekitarmu</p>
    </div>

    <!-- Progress Steps -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex flex-col items-center flex-1">
            <div id="step1-indicator" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold transition">1</div>
            <span class="text-sm text-gray-600 mt-2 font-medium">Foto</span>
        </div>
        <div class="flex-1 h-1 bg-gray-200 mx-2" id="line1-2"></div>
        <div class="flex flex-col items-center flex-1">
            <div id="step2-indicator" class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center font-semibold transition">2</div>
            <span class="text-sm text-gray-600 mt-2 font-medium">Lokasi</span>
        </div>
        <div class="flex-1 h-1 bg-gray-200 mx-2" id="line2-3"></div>
        <div class="flex flex-col items-center flex-1">
            <div id="step3-indicator" class="w-10 h-10 rounded-full bg-gray-300 text-white flex items-center justify-center font-semibold transition">3</div>
            <span class="text-sm text-gray-600 mt-2 font-medium">Detail</span>
        </div>
    </div>

    <form id="laporanForm" method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Step 1: Upload Foto -->
        <div id="step1" class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Foto Kerusakan</h2>
            <p class="text-gray-600 mb-6">Ambil foto kerusakan jalan yang jelas</p>

            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                <div id="previewContainer" class="hidden mb-4">
                    <img id="imagePreview" src="" alt="Preview" class="max-w-full h-64 object-contain mx-auto rounded-lg shadow">
                    <button type="button" onclick="removeImage()" class="mt-3 text-red-600 hover:text-red-800 text-sm font-medium">
                        🗑️ Hapus Foto
                    </button>
                </div>

                <div id="uploadPlaceholder">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Ambil Foto atau Pilih Galeri</h3>
                    <p class="text-gray-600 mb-6">Unggah foto kerusakan untuk laporan yang akurat</p>

                    <div class="grid grid-cols-2 gap-4 max-w-md mx-auto">
                        <button type="button" onclick="document.getElementById('cameraInput').click()" 
                                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            📷 Kamera
                        </button>
                        <button type="button" onclick="document.getElementById('galleryInput').click()" 
                                class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition flex items-center justify-center gap-2 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            🖼️ Galeri
                        </button>
                    </div>
                </div>

                <input type="file" id="cameraInput" accept="image/*" capture="camera" class="hidden" onchange="handleImageUpload(event)">
                <input type="file" id="galleryInput" accept="image/*" class="hidden" onchange="handleImageUpload(event)">
                <input type="hidden" id="photo_data" name="photo_data" required>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" onclick="goToStep(2)" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-2">
                    Lanjutkan 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Step 2: Lokasi dengan Peta -->
        <div id="step2" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Lokasi Kerusakan</h2>
            <p class="text-gray-600 mb-6">Tentukan lokasi kerusakan secara akurat</p>
            
            <!-- Peta Interaktif -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">🗺️ Pilih Lokasi di Peta</label>
                <div id="map" class="w-full h-80 rounded-lg border border-gray-300 z-0 shadow-sm"></div>
                <p class="text-xs text-gray-500 mt-2">💡 Klik pada peta untuk memilih lokasi. Marker akan muncul otomatis.</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="address" id="address" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Masukkan alamat lokasi kerusakan" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="number" step="any" name="latitude" id="latitude" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50"
                               placeholder="-6.2088" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="number" step="any" name="longitude" id="longitude" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50"
                               placeholder="106.8456" readonly>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="button" onclick="getLocation()" 
                            class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition flex items-center gap-2 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        📍 Gunakan Lokasi Saya
                    </button>
                    <button type="button" onclick="resetMap()" 
                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                        🔄 Reset Peta
                    </button>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="goToStep(1)" 
                        class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </button>
                <button type="button" onclick="goToStep(3)" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-2">
                    Lanjutkan 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Step 3: Detail -->
        <div id="step3" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Detail Laporan</h2>
            <p class="text-gray-600 mb-6">Lengkapi informasi kerusakan</p>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" id="category" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        <option value="lubang">Lubang Jalan</option>
                        <option value="retak">Retak Jalan</option>
                        <option value="banjir">Banjir/Genangan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urgensi <span class="text-red-500">*</span></label>
                    <select name="urgency" id="urgency" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Urgensi</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Jelaskan kondisi kerusakan secara detail..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Opsional, tapi sangat membantu</p>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="goToStep(2)" 
                        class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </button>
                <button type="submit" 
                        class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    ✅ Kirim Laporan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
console.log('✅ Create laporan JavaScript loaded!');

let currentStep = 1;
let hasImage = false;
let map = null;
let marker = null;

// Default location (Jakarta, Indonesia)
const DEFAULT_LAT = -0.0263;
const DEFAULT_LNG = 109.3425;

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});

function initMap() {
    if (map) return; // Prevent re-initialization
    
    // Create map
    map = L.map('map').setView([DEFAULT_LAT, DEFAULT_LNG], 13);
    
    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);
    
    // Click event on map
    map.on('click', function(e) {
        setMarker(e.latlng.lat, e.latlng.lng);
    });
    
    console.log('Map initialized');
}

function setMarker(lat, lng) {
    // Update input fields
    document.getElementById('latitude').value = lat.toFixed(6);
    document.getElementById('longitude').value = lng.toFixed(6);
    
    // Remove existing marker
    if (marker) {
        map.removeLayer(marker);
    }
    
    // Add new marker
    marker = L.marker([lat, lng]).addTo(map);
    marker.bindPopup('📍 Lokasi dipilih<br><small>' + lat.toFixed(6) + ', ' + lng.toFixed(6) + '</small>').openPopup();
    
    console.log('Marker set at:', lat, lng);
}

function goToStep(step) {
    console.log('Going to step:', step);
    
    // Validasi step 1: Harus ada foto
    if (currentStep === 1 && step === 2) {
        if (!hasImage || !document.getElementById('photo_data').value) {
            alert('⚠️ Silakan upload foto terlebih dahulu!');
            return;
        }
    }

    // Validasi step 2: Harus ada alamat
    if (currentStep === 2 && step === 3) {
        const address = document.getElementById('address').value.trim();
        if (!address) {
            alert('⚠️ Silakan isi alamat lokasi!');
            document.getElementById('address').focus();
            return;
        }
    }

    // Hide all steps
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step3').classList.add('hidden');
    
    // Show target step
    document.getElementById('step' + step).classList.remove('hidden');
    
    // Update indicators
    updateIndicators(step);
    
    currentStep = step;
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // Refresh map when entering step 2
    if (step === 2 && map) {
        setTimeout(() => {
            map.invalidateSize();
            console.log('Map refreshed');
        }, 200);
    }
}

function updateIndicators(step) {
    for (let i = 1; i <= 3; i++) {
        const indicator = document.getElementById('step' + i + '-indicator');
        const line = document.getElementById('line' + i + '-' + (i+1));
        
        if (i < step) {
            indicator.classList.remove('bg-gray-300');
            indicator.classList.add('bg-blue-600');
            if (line) {
                line.classList.remove('bg-gray-200');
                line.classList.add('bg-blue-600');
            }
        } else if (i === step) {
            indicator.classList.remove('bg-gray-300');
            indicator.classList.add('bg-blue-600');
        } else {
            indicator.classList.remove('bg-blue-600');
            indicator.classList.add('bg-gray-300');
        }
    }
}

function handleImageUpload(event) {
    console.log('Image upload triggered');
    const file = event.target.files[0];
    
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            alert('⚠️ Ukuran foto terlalu besar! Maksimal 5MB.');
            return;
        }
        
        if (!file.type.match('image.*')) {
            alert('⚠️ File harus berupa gambar!');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            console.log('Image loaded');
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('previewContainer').classList.remove('hidden');
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('photo_data').value = e.target.result;
            hasImage = true;
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    console.log('Removing image');
    document.getElementById('imagePreview').src = '';
    document.getElementById('previewContainer').classList.add('hidden');
    document.getElementById('uploadPlaceholder').classList.remove('hidden');
    document.getElementById('photo_data').value = '';
    document.getElementById('cameraInput').value = '';
    document.getElementById('galleryInput').value = '';
    hasImage = false;
}

function getLocation() {
    console.log('Getting location...');
    
    if (navigator.geolocation) {
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '⏳ Mendapatkan lokasi...';
        btn.disabled = true;
        
        navigator.geolocation.getCurrentPosition(
            function(position) {
                console.log('Location obtained');
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                
                // Update map
                setMarker(lat, lng);
                
                // Center map on new location
                if (map) {
                    map.setView([lat, lng], 16);
                }
                
                btn.innerHTML = '✅ Lokasi berhasil!';
                btn.classList.remove('bg-blue-100', 'text-blue-700');
                btn.classList.add('bg-green-100', 'text-green-700');
                
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                    btn.classList.remove('bg-green-100', 'text-green-700');
                    btn.classList.add('bg-blue-100', 'text-blue-700');
                }, 2000);
            },
            function(error) {
                console.error('Location error:', error);
                alert('⚠️ Gagal mendapatkan lokasi: ' + error.message + '\n\nSilakan aktifkan GPS atau pilih lokasi manual di peta.');
                btn.innerHTML = originalHTML;
                btn.disabled = false;
            }
        );
    } else {
        alert('⚠️ Geolocation tidak didukung browser ini.');
    }
}

function resetMap() {
    document.getElementById('latitude').value = '';
    document.getElementById('longitude').value = '';
    
    if (map) {
        map.setView([DEFAULT_LAT, DEFAULT_LNG], 13);
        if (marker) {
            map.removeLayer(marker);
            marker = null;
        }
    }
    
    console.log('Map reset');
}

// Form validation before submit
document.getElementById('laporanForm').addEventListener('submit', function(e) {
    const photoData = document.getElementById('photo_data').value;
    const address = document.getElementById('address').value.trim();
    const category = document.getElementById('category').value;
    const urgency = document.getElementById('urgency').value;
    
    if (!photoData) {
        e.preventDefault();
        alert('⚠️ Silakan upload foto!');
        goToStep(1);
        return false;
    }
    
    if (!address) {
        e.preventDefault();
        alert('⚠️ Silakan isi alamat!');
        goToStep(2);
        return false;
    }
    
    if (!category) {
        e.preventDefault();
        alert('⚠️ Silakan pilih kategori!');
        goToStep(3);
        document.getElementById('category').focus();
        return false;
    }
    
    if (!urgency) {
        e.preventDefault();
        alert('⚠️ Silakan pilih urgensi!');
        goToStep(3);
        document.getElementById('urgency').focus();
        return false;
    }
    
    // Show loading
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '⏳ Mengirim laporan...';
});
</script>
@endsection