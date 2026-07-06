@extends('layouts.app')

@section('title', 'Tambah Laporan - Road Care')

@section('content')
<div class="px-5 pb-32">
    <!-- Header -->
    <div class="mt-5 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Laporan</h2>
        <p class="text-sm text-gray-500 mt-1">Laporkan kerusakan jalan di sekitarmu</p>
    </div>

    <!-- Progress Steps -->
    <div class="mb-6">
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 rounded-full"></div>
            <div id="progressLine" class="absolute top-1/2 left-0 h-1 bg-blue-600 -translate-y-1/2 rounded-full transition-all duration-300" style="width: 0%"></div>

            <div id="step1Indicator" class="w-10 h-10 rounded-full flex items-center justify-center font-bold z-10 bg-blue-600 text-white transition-all">
                <span>📷</span>
            </div>
            <div id="step2Indicator" class="w-10 h-10 rounded-full flex items-center justify-center font-bold z-10 bg-gray-200 text-gray-500 transition-all">
                <span>📍</span>
            </div>
            <div id="step3Indicator" class="w-10 h-10 rounded-full flex items-center justify-center font-bold z-10 bg-gray-200 text-gray-500 transition-all">
                <span>📝</span>
            </div>
        </div>
        <div class="flex justify-between mt-2 text-xs text-gray-500">
            <span>Foto</span>
            <span>Lokasi</span>
            <span>Detail</span>
        </div>
    </div>

    <form id="reportForm" action="{{ route('laporan.store') }}" method="POST">
        @csrf

        <!-- STEP 1: Foto -->
        <div id="step1" class="step-content">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Foto Kerusakan</h3>
            <p class="text-sm text-gray-500 mb-4">Ambil foto kerusakan jalan yang jelas</p>

            <!-- Upload Area -->
            <div id="uploadArea" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center mb-4">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-3xl">📷</span>
                </div>
                <h4 class="font-semibold text-gray-800 mb-1">Ambil Foto atau Pilih Galeri</h4>
                <p class="text-sm text-gray-500 mb-4">Unggah foto kerusakan untuk laporan yang akurat</p>

                <div class="flex gap-3">
                    <button type="button" onclick="openCamera()" class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                        📷 Kamera
                    </button>
                    <button type="button" onclick="document.getElementById('fileInput').click()" class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-200 transition">
                        🖼️ Galeri
                    </button>
                </div>
                <input type="file" id="fileInput" accept="image/*" class="hidden" onchange="handleFileSelect(event)">
            </div>

            <!-- Camera View -->
            <div id="cameraView" class="hidden relative bg-black rounded-2xl overflow-hidden mb-4" style="height: 400px;">
                <video id="video" autoplay playsinline class="w-full h-full object-cover"></video>
                <canvas id="canvas" class="hidden"></canvas>

                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-4">
                    <button type="button" onclick="closeCamera()" class="w-12 h-12 bg-gray-800 bg-opacity-50 text-white rounded-full hover:bg-opacity-70 transition">✕</button>
                    <button type="button" onclick="capturePhoto()" class="w-16 h-16 bg-white rounded-full border-4 border-gray-300 hover:border-white transition"></button>
                    <button type="button" onclick="switchCamera()" class="w-12 h-12 bg-gray-800 bg-opacity-50 text-white rounded-full hover:bg-opacity-70 transition">🔄</button>
                </div>
            </div>

            <!-- Preview -->
            <div id="previewArea" class="hidden">
                <div class="relative rounded-2xl overflow-hidden mb-4">
                    <img id="previewImage" class="w-full h-64 object-cover">
                </div>

                <button type="button" onclick="nextStep()" class="w-full bg-green-600 text-white py-4 rounded-xl font-semibold mb-2 hover:bg-green-700 transition">
                    ✓ Gunakan Foto ini
                </button>
                <button type="button" onclick="retakePhoto()" class="w-full bg-white border border-gray-300 text-gray-700 py-4 rounded-xl font-semibold hover:bg-gray-50 transition">
                    🔄 Ambil ulang
                </button>
            </div>

            <input type="hidden" name="photo_data" id="photoData">
        </div>

        <!-- STEP 2: Lokasi -->
        <div id="step2" class="step-content hidden">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Lokasi Kejadian</h3>
                    <p class="text-sm text-gray-500">Tandai lokasi kerusakan jalan</p>
                </div>
                <button type="button" onclick="detectLocation()" class="text-sm text-blue-600 font-medium px-3 py-1 bg-blue-50 rounded-full hover:bg-blue-100 transition">
                    📍 Otomatis
                </button>
            </div>

            <!-- Map Placeholder -->
            <div class="bg-gray-200 rounded-2xl overflow-hidden border border-gray-300 mb-4" style="height: 250px;">
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-green-50">
                    <div class="text-center">
                        <div class="text-5xl mb-2">📍</div>
                        <p class="text-sm text-gray-600">Klik "Deteksi Otomatis" atau isi alamat manual</p>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" id="addressInput" rows="3"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan"></textarea>
                </div>
            </div>

            <input type="hidden" name="latitude" id="latitudeInput">
            <input type="hidden" name="longitude" id="longitudeInput">
        </div>

        <!-- STEP 3: Detail -->
        <div id="step3" class="step-content hidden">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Detail Laporan</h3>
            <p class="text-sm text-gray-500 mb-4">Lengkapi informasi kerusakan</p>

            <div class="space-y-4">
                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Kerusakan</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="category" value="lubang" class="peer hidden" required>
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition">
                                <div class="text-2xl mb-1">🕳️</div>
                                <div class="text-sm font-medium">Lubang</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="category" value="retak" class="peer hidden">
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition">
                                <div class="text-2xl mb-1">💥</div>
                                <div class="text-sm font-medium">Retak</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="category" value="banjir" class="peer hidden">
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition">
                                <div class="text-2xl mb-1">🌊</div>
                                <div class="text-sm font-medium">Banjir</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="category" value="lainnya" class="peer hidden">
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 transition">
                                <div class="text-2xl mb-1">⚠️</div>
                                <div class="text-sm font-medium">Lainnya</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Urgensi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Urgensi</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="urgency" value="rendah" class="peer hidden">
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-green-500 peer-checked:bg-green-50 transition">
                                <div class="text-sm font-medium text-green-700">Rendah</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="urgency" value="sedang" class="peer hidden" checked>
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-orange-500 peer-checked:bg-orange-50 transition">
                                <div class="text-sm font-medium text-orange-700">Sedang</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="urgency" value="tinggi" class="peer hidden">
                            <div class="border-2 border-gray-300 rounded-xl p-3 text-center peer-checked:border-red-500 peer-checked:bg-red-50 transition">
                                <div class="text-sm font-medium text-red-700">Tinggi</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="3"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Jelaskan kondisi kerusakan..."></textarea>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="fixed bottom-24 left-5 right-5 max-w-[370px] mx-auto space-y-2">
            <button type="button" id="prevBtn" onclick="prevStep()" class="hidden w-full bg-gray-200 text-gray-700 py-4 rounded-xl font-semibold hover:bg-gray-300 transition">
                ← Kembali
            </button>
            <button type="button" id="nextBtn" onclick="nextStep()" class="w-full bg-blue-600 text-white py-4 rounded-xl font-semibold hover:bg-blue-700 transition">
                Lanjutkan →
            </button>
            <button type="submit" id="submitBtn" class="hidden w-full bg-green-600 text-white py-4 rounded-xl font-semibold hover:bg-green-700 transition">
                ✓ Kirim Laporan
            </button>
        </div>
    </form>
</div>

@if(session('success'))
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full text-center">
        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Berhasil!</h3>
        <p class="text-gray-600 mb-4">{{ session('success') }}</p>
        <button onclick="document.getElementById('successModal').remove()" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700">
            OK
        </button>
    </div>
</div>
@endif

@push('scripts')
<script>
let currentStep = 1;
let stream = null;
let facingMode = 'environment';

// Camera Functions
async function openCamera() {
    document.getElementById('uploadArea').classList.add('hidden');
    document.getElementById('cameraView').classList.remove('hidden');

    try {
        stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: facingMode, width: { ideal: 1280 }, height: { ideal: 720 } }
        });
        document.getElementById('video').srcObject = stream;
    } catch (err) {
        alert('Tidak bisa akses kamera: ' + err.message);
        closeCamera();
    }
}

function closeCamera() {
    document.getElementById('cameraView').classList.add('hidden');
    document.getElementById('uploadArea').classList.remove('hidden');
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
}

function switchCamera() {
    facingMode = facingMode === 'environment' ? 'user' : 'environment';
    closeCamera();
    openCamera();
}

function capturePhoto() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
    showPreview(dataUrl);

    if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
    }
}

function handleFileSelect(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => showPreview(e.target.result);
        reader.readAsDataURL(file);
    }
}

function showPreview(dataUrl) {
    document.getElementById('cameraView').classList.add('hidden');
    document.getElementById('uploadArea').classList.add('hidden');
    document.getElementById('previewArea').classList.remove('hidden');
    document.getElementById('previewImage').src = dataUrl;
    document.getElementById('photoData').value = dataUrl;
}

function retakePhoto() {
    document.getElementById('previewArea').classList.add('hidden');
    document.getElementById('uploadArea').classList.remove('hidden');
    document.getElementById('photoData').value = '';
}

// Location Functions
function detectLocation() {
    if (!navigator.geolocation) {
        alert('Browser tidak mendukung GPS');
        return;
    }

    navigator.geolocation.getCurrentPosition(
        (position) => {
            document.getElementById('latitudeInput').value = position.coords.latitude;
            document.getElementById('longitudeInput').value = position.coords.longitude;
            document.getElementById('addressInput').value = 'Lokasi terdeteksi (Lat: ' + position.coords.latitude.toFixed(6) + ', Lng: ' + position.coords.longitude.toFixed(6) + ')';
            alert('✓ Lokasi berhasil terdeteksi!');
        },
        (error) => {
            alert('Gagal mendapatkan lokasi: ' + error.message);
        }
    );
}

// Step Navigation
function updateStepper() {
    for (let i = 1; i <= 3; i++) {
        const indicator = document.getElementById(`step${i}Indicator`);
        if (i < currentStep) {
            indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold z-10 transition-all bg-green-500 text-white';
            indicator.innerHTML = '<span>✓</span>';
        } else if (i === currentStep) {
            const icons = {1: '📷', 2: '📍', 3: '📝'};
            indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold z-10 transition-all bg-blue-600 text-white';
            indicator.innerHTML = `<span>${icons[i]}</span>`;
        } else {
            const icons = {1: '📷', 2: '📍', 3: '📝'};
            indicator.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold z-10 transition-all bg-gray-200 text-gray-500';
            indicator.innerHTML = `<span>${icons[i]}</span>`;
        }
    }

    const progress = ((currentStep - 1) / 2) * 100;
    document.getElementById('progressLine').style.width = `${progress}%`;

    document.querySelectorAll('.step-content').forEach((el, idx) => {
        el.classList.toggle('hidden', idx + 1 !== currentStep);
    });

    document.getElementById('prevBtn').classList.toggle('hidden', currentStep === 1);
    document.getElementById('nextBtn').classList.toggle('hidden', currentStep === 3);
    document.getElementById('submitBtn').classList.toggle('hidden', currentStep !== 3);
}

function nextStep() {
    if (currentStep === 1 && !document.getElementById('photoData').value) {
        alert('⚠️ Foto wajib diisi!');
        return;
    }

    if (currentStep < 3) {
        currentStep++;
        updateStepper();
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepper();
    }
}

// Form Validation
document.getElementById('reportForm').addEventListener('submit', function(e) {
    const category = document.querySelector('input[name="category"]:checked');
    if (!category) {
        e.preventDefault();
        alert('⚠️ Pilih kategori kerusakan!');
        return;
    }
});

// Initialize
updateStepper();
</script>
@endpush
@endsection
