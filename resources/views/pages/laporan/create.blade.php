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
            <p class="text-gray-600 mb-6">Ambil foto kerusakan jalan yang jelas. AI akan otomatis menganalisis foto Anda.</p>

            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                <div id="previewContainer" class="hidden mb-4">
                    <img id="imagePreview" src="" alt="Preview" class="max-w-full h-64 object-contain mx-auto rounded-lg shadow">
                    <button type="button" onclick="removeImage()" class="mt-3 text-red-600 hover:text-red-800 text-sm font-medium">
                        🗑️ Hapus Foto
                    </button>
                    
                    <!-- Tempat hasil AI muncul di Step 1 -->
                    <div id="step1-ai-result" class="mt-4"></div>
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
                             Kamera
                        </button>
                        <button type="button" onclick="document.getElementById('galleryInput').click()" 
                                class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition flex items-center justify-center gap-2 font-medium">
                            ️ Galeri
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
                    Lanjutkan →
                </button>
            </div>
        </div>

        <!-- Step 2: Lokasi dengan Peta -->
        <div id="step2" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Lokasi Kerusakan</h2>
            <p class="text-gray-600 mb-6">Tentukan lokasi kerusakan secara akurat</p>
            
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
                               placeholder="-0.0263" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="number" step="any" name="longitude" id="longitude" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50"
                               placeholder="109.3425" readonly>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="button" onclick="getLocation()" 
                            class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition flex items-center gap-2 text-sm font-medium">
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
                    ← Kembali
                </button>
                <button type="button" onclick="goToStep(3)" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-2">
                    Lanjutkan →
                </button>
            </div>
        </div>

        <!-- Step 3: Detail -->
        <div id="step3" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Detail Laporan</h2>
            <p class="text-gray-600 mb-6">Lengkapi informasi kerusakan</p>
            
            <!-- Pesan auto-fill dari AI -->
            <div id="ai-auto-fill-msg" class="hidden mb-4 bg-green-50 border-2 border-green-300 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-green-800 mb-1">✅ AI Telah Mengisi Otomatis</h4>
                        <p class="text-sm text-green-700" id="ai-fill-details">-</p>
                        <button type="button" onclick="resetToManual()" class="mt-2 text-xs text-green-600 hover:text-green-800 underline font-medium">
                            🔄 Reset dan pilih manual
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" id="category" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
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
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
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
                    ← Kembali
                </button>
                <button type="submit" 
                        class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-medium flex items-center gap-2">
                    ✅ Kirim Laporan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
console.log('✅ Create laporan JavaScript loaded!');

let currentStep = 1;
let hasImage = false;
let map = null;
let marker = null;
const DEFAULT_LAT = -0.0263;
const DEFAULT_LNG = 109.3425;
let currentAnalysis = null;
let aiAutoFilled = false;

document.addEventListener('DOMContentLoaded', function() { initMap(); });

function initMap() {
    if (map) return;
    map = L.map('map').setView([DEFAULT_LAT, DEFAULT_LNG], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);
    map.on('click', function(e) { setMarker(e.latlng.lat, e.latlng.lng); });
}

function setMarker(lat, lng) {
    document.getElementById('latitude').value = lat.toFixed(6);
    document.getElementById('longitude').value = lng.toFixed(6);
    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map);
    marker.bindPopup('📍 Lokasi dipilih<br><small>' + lat.toFixed(6) + ', ' + lng.toFixed(6) + '</small>').openPopup();
}

function goToStep(step) {
    if (currentStep === 1 && step === 2) {
        if (!hasImage || !document.getElementById('photo_data').value) {
            alert('⚠️ Silakan upload foto terlebih dahulu!'); return;
        }
    }
    if (currentStep === 2 && step === 3) {
        const address = document.getElementById('address').value.trim();
        if (!address) { alert('️ Silakan isi alamat lokasi!'); document.getElementById('address').focus(); return; }
    }

    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step3').classList.add('hidden');
    document.getElementById('step' + step).classList.remove('hidden');
    updateIndicators(step);
    currentStep = step;
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // ✅ AUTO-FILL DROPDOWN DI STEP 3 JIKA ADA HASIL AI
    if (step === 3 && currentAnalysis && !aiAutoFilled) {
        autoFillFromAI();
    }
    
    if (step === 2 && map) setTimeout(() => { map.invalidateSize(); }, 200);
}

// ✅ FUNGSI AUTO-FILL DARI AI
function autoFillFromAI() {
    if (!currentAnalysis) return;
    
    // Isi dropdown
    document.getElementById('category').value = currentAnalysis.category;
    document.getElementById('urgency').value = currentAnalysis.urgency;
    
    // Highlight dropdown dengan warna hijau
    const categorySelect = document.getElementById('category');
    const urgencySelect = document.getElementById('urgency');
    
    categorySelect.classList.add('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
    urgencySelect.classList.add('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
    
    // Tampilkan pesan konfirmasi
    const msgDiv = document.getElementById('ai-auto-fill-msg');
    const detailsText = document.getElementById('ai-fill-details');
    
    detailsText.innerHTML = `
        <strong>${currentAnalysis.detectedClass}</strong><br>
        <span class="text-xs">Kepercayaan: ${(currentAnalysis.score * 100).toFixed(1)}% | Kategori: ${currentAnalysis.category.toUpperCase()} | Urgensi: ${currentAnalysis.urgency.toUpperCase()}</span>
    `;
    
    msgDiv.classList.remove('hidden');
    aiAutoFilled = true;
    
    // Hapus highlight setelah 3 detik
    setTimeout(() => {
        categorySelect.classList.remove('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
        urgencySelect.classList.remove('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
    }, 3000);
    
    console.log('AI Auto-filled:', currentAnalysis);
}

// ✅ FUNGSI RESET KE MANUAL
function resetToManual() {
    document.getElementById('category').value = '';
    document.getElementById('urgency').value = '';
    document.getElementById('ai-auto-fill-msg').classList.add('hidden');
    aiAutoFilled = false;
    
    const categorySelect = document.getElementById('category');
    const urgencySelect = document.getElementById('urgency');
    categorySelect.classList.remove('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
    urgencySelect.classList.remove('border-green-500', 'bg-green-50', 'ring-2', 'ring-green-200');
}

function updateIndicators(step) {
    for (let i = 1; i <= 3; i++) {
        const indicator = document.getElementById('step' + i + '-indicator');
        const line = document.getElementById('line' + i + '-' + (i+1));
        if (i < step) {
            indicator.classList.remove('bg-gray-300'); indicator.classList.add('bg-blue-600');
            if (line) { line.classList.remove('bg-gray-200'); line.classList.add('bg-blue-600'); }
        } else if (i === step) {
            indicator.classList.remove('bg-gray-300'); indicator.classList.add('bg-blue-600');
        } else {
            indicator.classList.remove('bg-blue-600'); indicator.classList.add('bg-gray-300');
        }
    }
}

// ==========================================
// FUNGSI UPLOAD & AUTO DETECT DI STEP 1
// ==========================================
function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        if (file.size > 5 * 1024 * 1024) { alert('️ Ukuran foto terlalu besar! Maksimal 5MB.'); return; }
        if (!file.type.match('image.*')) { alert('⚠️ File harus berupa gambar!'); return; }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('previewContainer').classList.remove('hidden');
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('photo_data').value = e.target.result;
            hasImage = true;
            
            // Reset hasil sebelumnya
            currentAnalysis = null;
            aiAutoFilled = false;
            document.getElementById('step1-ai-result').innerHTML = `
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mt-4">
                    <div class="flex items-center gap-3">
                        <svg class="animate-spin h-6 w-6 text-purple-600" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-purple-800">🤖 AI sedang menganalisis foto...</p>
                            <p class="text-xs text-purple-600">Mendeteksi jenis kerusakan jalan</p>
                        </div>
                    </div>
                </div>
            `;
            
            setTimeout(() => { detectDamageImmediately(); }, 500);
        };
        reader.readAsDataURL(file);
    }
}

async function detectDamageImmediately() {
    const photoData = document.getElementById('photo_data').value;
    if (!photoData) return;

    try {
        const imageElement = await base64ToImage(photoData);
        const analysis = await analyzeImageWithCanvas(imageElement);
        currentAnalysis = analysis;
        
        document.getElementById('step1-ai-result').innerHTML = `
            <div class="bg-green-50 border-2 border-green-300 rounded-lg p-4 mt-4 text-left">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-green-800 mb-2">✅ Hasil Deteksi AI</h4>
                        <div class="space-y-1 text-sm">
                            <p class="text-green-700"><span class="font-medium">Jenis:</span> <span class="font-bold">${analysis.detectedClass}</span></p>
                            <p class="text-green-700"><span class="font-medium">Kepercayaan:</span> <span class="font-bold">${(analysis.score * 100).toFixed(1)}%</span></p>
                            <p class="text-green-700"><span class="font-medium">Kategori:</span> <span class="font-bold uppercase">${analysis.category}</span></p>
                            <p class="text-green-700"><span class="font-medium">Urgensi:</span> <span class="font-bold uppercase">${analysis.urgency}</span></p>
                        </div>
                        <p class="text-xs text-green-600 mt-3 italic"> Hasil ini akan otomatis terisi saat Anda mencapai Step 3.</p>
                    </div>
                </div>
            </div>
        `;
        console.log('AI Detection complete:', analysis);
    } catch (error) {
        console.error('Detection error:', error);
        document.getElementById('step1-ai-result').innerHTML = `
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-4">
                <p class="text-sm text-red-800">❌ Gagal menganalisis foto.</p>
            </div>
        `;
    }
}

function removeImage() {
    document.getElementById('imagePreview').src = '';
    document.getElementById('previewContainer').classList.add('hidden');
    document.getElementById('uploadPlaceholder').classList.remove('hidden');
    document.getElementById('photo_data').value = '';
    document.getElementById('cameraInput').value = '';
    document.getElementById('galleryInput').value = '';
    document.getElementById('step1-ai-result').innerHTML = '';
    hasImage = false;
    currentAnalysis = null;
    aiAutoFilled = false;
}

function getLocation() {
    if (navigator.geolocation) {
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '⏳ Mendapatkan lokasi...'; btn.disabled = true;
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude; const lng = position.coords.longitude;
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
                setMarker(lat, lng);
                if (map) map.setView([lat, lng], 16);
                btn.innerHTML = '✅ Lokasi berhasil!';
                btn.classList.remove('bg-blue-100', 'text-blue-700'); btn.classList.add('bg-green-100', 'text-green-700');
                setTimeout(() => { btn.innerHTML = originalHTML; btn.disabled = false; btn.classList.remove('bg-green-100', 'text-green-700'); btn.classList.add('bg-blue-100', 'text-blue-700'); }, 2000);
            },
            function(error) { alert('⚠️ Gagal mendapatkan lokasi: ' + error.message); btn.innerHTML = originalHTML; btn.disabled = false; }
        );
    } else { alert('⚠️ Geolocation tidak didukung browser ini.'); }
}

function resetMap() {
    document.getElementById('latitude').value = ''; document.getElementById('longitude').value = '';
    if (map) { map.setView([DEFAULT_LAT, DEFAULT_LNG], 13); if (marker) { map.removeLayer(marker); marker = null; } }
}

// ==========================================
// FUNGSI AI: CANVAS IMAGE PROCESSING
// ==========================================
async function analyzeImageWithCanvas(img) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    const maxSize = 400;
    const scale = Math.min(maxSize / img.width, maxSize / img.height, 1);
    canvas.width = img.width * scale; canvas.height = img.height * scale;
    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = imageData.data;

    let darkPixels = 0, bluePixels = 0, edgePixels = 0, totalSamples = 0;
    const step = 4;

    for (let y = 0; y < canvas.height; y += step) {
        for (let x = 0; x < canvas.width; x += step) {
            const idx = (y * canvas.width + x) * 4;
            const r = data[idx], g = data[idx+1], b = data[idx+2];
            totalSamples++;
            if (r < 60 && g < 60 && b < 60) darkPixels++;
            if (b > r + 15 && b > 80) bluePixels++;
        }
    }

    for (let y = 2; y < canvas.height - 2; y += 3) {
        for (let x = 2; x < canvas.width - 2; x += 3) {
            const idx = (y * canvas.width + x) * 4;
            const brightness = (data[idx] + data[idx+1] + data[idx+2]) / 3;
            const rightIdx = (y * canvas.width + (x+2)) * 4;
            const bottomIdx = ((y+2) * canvas.width + x) * 4;
            const rightB = (data[rightIdx] + data[rightIdx+1] + data[rightIdx+2]) / 3;
            const bottomB = (data[bottomIdx] + data[bottomIdx+1] + data[bottomIdx+2]) / 3;
            if (Math.abs(brightness - rightB) > 40 || Math.abs(brightness - bottomB) > 40) edgePixels++;
        }
    }

    const darkRatio = darkPixels / totalSamples;
    const blueRatio = bluePixels / totalSamples;
    const edgeRatio = edgePixels / totalSamples;
    console.log('AI Analysis Ratios:', { darkRatio, blueRatio, edgeRatio });

    if (blueRatio > 0.12) return { category: 'banjir', urgency: 'tinggi', detectedClass: 'Genangan Air / Banjir', score: Math.min(blueRatio * 4, 0.95) };
    if (darkRatio > 0.08) return { category: 'lubang', urgency: 'tinggi', detectedClass: 'Lubang / Area Gelap', score: Math.min(darkRatio * 5, 0.95) };
    if (edgeRatio > 0.20) return { category: 'retak', urgency: edgeRatio > 0.30 ? 'tinggi' : 'sedang', detectedClass: 'Retakan / Tekstur Rusak', score: Math.min(edgeRatio / 0.4, 0.90) };
    return { category: 'lainnya', urgency: 'rendah', detectedClass: 'Permukaan Jalan Normal/Minor', score: 0.50 };
}

function base64ToImage(base64) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        img.onload = () => resolve(img);
        img.onerror = reject;
        img.src = base64;
    });
}

// Form validation before submit
document.getElementById('laporanForm').addEventListener('submit', function(e) {
    const photoData = document.getElementById('photo_data').value;
    const address = document.getElementById('address').value.trim();
    const category = document.getElementById('category').value;
    const urgency = document.getElementById('urgency').value;
    
    if (!photoData) { e.preventDefault(); alert('⚠️ Silakan upload foto!'); goToStep(1); return false; }
    if (!address) { e.preventDefault(); alert('⚠️ Silakan isi alamat!'); goToStep(2); return false; }
    if (!category) { e.preventDefault(); alert('️ Silakan pilih kategori!'); goToStep(3); document.getElementById('category').focus(); return false; }
    if (!urgency) { e.preventDefault(); alert('⚠️ Silakan pilih urgensi!'); goToStep(3); document.getElementById('urgency').focus(); return false; }
    
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true; submitBtn.innerHTML = ' Mengirim laporan...';
});
</script>
@endsection