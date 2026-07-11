@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Laporan</h1>
        <p class="text-gray-600 mt-2">Laporkan kerusakan jalan di sekitarmu</p>
    </div>

    <form id="laporanForm" method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Step 1: Upload Foto -->
        <div id="step1" class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Foto Kerusakan</h2>

            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                <div id="previewContainer" class="hidden mb-4">
                    <img id="imagePreview" src="" alt="Preview" class="max-w-full h-64 object-contain mx-auto rounded-lg">
                </div>

                <div id="uploadPlaceholder">
                    <h3 class="text-lg font-semibold mb-4">Upload Foto</h3>
                    <div class="flex gap-4 justify-center">
                        <button type="button" onclick="document.getElementById('cameraInput').click()"
                                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                             Kamera
                        </button>
                        <button type="button" onclick="document.getElementById('galleryInput').click()"
                                class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200">
                            🖼️ Galeri
                        </button>
                    </div>
                </div>

                <input type="file" id="cameraInput" accept="image/*" capture="camera" class="hidden" onchange="handleImageUpload(event)">
                <input type="file" id="galleryInput" accept="image/*" class="hidden" onchange="handleImageUpload(event)">
                <input type="hidden" id="photo_data" name="photo_data">
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" onclick="goToStep(2)" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700">
                    Lanjutkan →
                </button>
            </div>
        </div>

        <!-- Step 2: Lokasi -->
        <div id="step2" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Lokasi Kerusakan</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <input type="text" name="address" id="address"
                           class="w-full px-4 py-2 border rounded-lg" placeholder="Masukkan alamat">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="number" step="any" name="latitude" id="latitude"
                               class="w-full px-4 py-2 border rounded-lg" placeholder="-6.2088">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="number" step="any" name="longitude" id="longitude"
                               class="w-full px-4 py-2 border rounded-lg" placeholder="106.8456">
                    </div>
                </div>

                <button type="button" onclick="getLocation()" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
                    📍 Gunakan Lokasi Saya
                </button>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="goToStep(1)" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300">
                    ← Kembali
                </button>
                <button type="button" onclick="goToStep(3)" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700">
                    Lanjutkan →
                </button>
            </div>
        </div>

        <!-- Step 3: Detail -->
        <div id="step3" class="bg-white rounded-lg shadow p-6 mb-6 hidden">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Detail Laporan</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 border rounded-lg">
                        <option value="">Pilih Kategori</option>
                        <option value="lubang">Lubang Jalan</option>
                        <option value="retak">Retak Jalan</option>
                        <option value="banjir">Banjir/Genangan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urgensi</label>
                    <select name="urgency" class="w-full px-4 py-2 border rounded-lg">
                        <option value="">Pilih Urgensi</option>
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-2 border rounded-lg" placeholder="Jelaskan kondisi..."></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="goToStep(2)" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300">
                    ← Kembali
                </button>
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700">
                    ✅ Kirim Laporan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
console.log('JavaScript loaded!');

function goToStep(step) {
    console.log('Going to step:', step);

    // Hide all steps
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step3').classList.add('hidden');

    // Show target step
    document.getElementById('step' + step).classList.remove('hidden');

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function handleImageUpload(event) {
    console.log('Image upload triggered');
    const file = event.target.files[0];

    if (file) {
        console.log('File selected:', file.name);

        const reader = new FileReader();
        reader.onload = function(e) {
            console.log('Image loaded');
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('previewContainer').classList.remove('hidden');
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('photo_data').value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function getLocation() {
    console.log('Getting location...');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                console.log('Location obtained');
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                alert('✅ Lokasi berhasil didapatkan!');
            },
            function(error) {
                console.error('Location error:', error);
                alert('⚠️ Gagal mendapatkan lokasi: ' + error.message);
            }
        );
    } else {
        alert('⚠️ Geolocation tidak didukung');
    }
}
</script>
@endsection
