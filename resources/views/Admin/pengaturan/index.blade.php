@extends('Admin.layout.app')

<<<<<<< HEAD
@section('page-header')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Pengaturan Sistem</h1>
    <p class="text-gray-600 mt-2">Kelola konfigurasi dan pengaturan aplikasi RoadCare</p>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.pengaturan.update') }}">
        @csrf
        
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Umum</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                        <input type="text" name="app_name" value="RoadCare" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Admin</label>
                        <input type="email" name="admin_email" value="admin@roadcare.com" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Notifikasi</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="email_notification" id="email_notification" 
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="email_notification" class="ml-3 text-sm text-gray-700">
                            Aktifkan notifikasi email
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="sms_notification" id="sms_notification" 
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="sms_notification" class="ml-3 text-sm text-gray-700">
                            Aktifkan notifikasi SMS
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                💾 Simpan Pengaturan
            </button>
            <button type="reset" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Reset
            </button>
        </div>
    </form>
=======
@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Pengaturan Aplikasi</h2>
        <p class="text-sm text-slate-500 mt-1">Konfigurasi informasi dasar, kontak instansi, dan identitas global sistem.</p>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 text-emerald-800 border border-emerald-200 p-4 rounded-xl shadow-sm animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('pengaturan.update') }}" method="POST" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @csrf

        <div class="p-6 space-y-6">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Aplikasi / Sistem</label>
                    <input type="text" name="nama_aplikasi" value="RoadCare" 
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Admin</label>
                    <input type="email" name="email" value="admin@roadcare.com" 
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Telepon Instansi</label>
                    <input type="text" name="telepon" value="08123456789" 
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Kantor / Operasional</label>
                    <textarea name="alamat" rows="3" 
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">Pontianak, Kalimantan Barat</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Teks Hak Cipta (Footer)</label>
                    <input type="text" name="footer" value="© 2026 RoadCare" 
                        class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
                </div>
            </div>

        </div>

        <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-end">
            <button type="submit" 
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-5 py-2.5 text-sm font-semibold rounded-xl shadow-md shadow-blue-500/10 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Simpan Konfigurasi
            </button>
        </div>
    </form>

>>>>>>> origin/UI-Admin-dan-pengguna
</div>
@endsection