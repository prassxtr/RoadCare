@extends('Admin.layout.app')

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
</div>
@endsection