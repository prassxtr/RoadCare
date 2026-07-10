@extends('Admin.layout.app')

@section('page-header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Manajemen Laporan</h1>
    <p class="text-gray-600 mt-2">Kelola semua laporan dari pengguna</p>
</div>
@endsection

@section('content')
<!-- Statistik Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
        <p class="text-sm text-gray-600">Total Laporan</p>
        <p class="text-2xl font-bold text-gray-800">{{ $totalLaporan }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
        <p class="text-sm text-gray-600">Pending</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $totalPending }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4 border-l-4 border-orange-500">
        <p class="text-sm text-gray-600">Proses</p>
        <p class="text-2xl font-bold text-orange-600">{{ $totalProses }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
        <p class="text-sm text-gray-600">Selesai</p>
        <p class="text-2xl font-bold text-green-600">{{ $totalSelesai }}</p>
    </div>
</div>

<!-- Filter & Search -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Cari kategori, deskripsi, alamat..." 
               class="md:col-span-2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <select name="status" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <select name="urgensi" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Urgensi</option>
            <option value="rendah" {{ request('urgensi') == 'rendah' ? 'selected' : '' }}>Rendah</option>
            <option value="sedang" {{ request('urgensi') == 'sedang' ? 'selected' : '' }}>Sedang</option>
            <option value="tinggi" {{ request('urgensi') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Filter
        </button>
    </form>
</div>

<!-- Tabel Laporan -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelapor</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Urgensi</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($laporans as $laporan)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-sm text-gray-900">#{{ $laporan->id }}</td>
                <td class="px-4 py-3">
                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto" 
                         class="w-12 h-12 object-cover rounded">
                </td>
                <td class="px-4 py-3 text-sm text-gray-900 capitalize">{{ $laporan->kategori }}</td>
                <td class="px-4 py-3 text-sm text-gray-900">{{ $laporan->user->name ?? 'Unknown' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                        @if($laporan->urgensi == 'tinggi') bg-red-100 text-red-800
                        @elseif($laporan->urgensi == 'sedang') bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800
                        @endif">
                        {{ ucfirst($laporan->urgensi) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                        @if($laporan->status == 'selesai') bg-green-100 text-green-800
                        @elseif($laporan->status == 'proses') bg-orange-100 text-orange-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-sm text-gray-500">{{ $laporan->created_at->format('d M Y') }}</td>
                <td class="px-4 py-3 text-center">
                    <a href="{{ route('admin.laporan.show', $laporan->id) }}" 
                       class="text-blue-600 hover:text-blue-900 text-sm font-medium">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                    Tidak ada laporan ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    @if($laporans->hasPages())
    <div class="px-4 py-3 border-t">
        {{ $laporans->links() }}
    </div>
    @endif
</div>
@endsection