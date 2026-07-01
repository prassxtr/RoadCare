@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Pengguna</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola hak akses, peranan, dan akun petugas operator sistem RoadCare.</p>
        </div>
        <button class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 text-sm font-semibold rounded-xl shadow-sm transition-all self-start sm:self-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
            </svg>
            Tambah User Baru
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-center gap-3">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg font-bold text-xs">ADM</div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase">Administrator</p>
                <p class="text-lg font-bold text-slate-800">1 Akun</p>
            </div>
        </div>
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-center gap-3">
            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg font-bold text-xs">STF</div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase">Petugas Lapangan</p>
                <p class="text-lg font-bold text-slate-800">4 Akun</p>
            </div>
        </div>
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-center gap-3">
            <div class="p-2 bg-purple-50 text-purple-600 rounded-lg font-bold text-xs">MSR</div>
            <div>
                <p class="text-xs text-slate-400 font-medium uppercase">Masyarakat</p>
                <p class="text-lg font-bold text-slate-800">128 Akun</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                        <th class="py-4 px-6">Pengguna</th>
                        <th class="py-4 px-6">Email</th>
                        <th class="py-4 px-6">Peran (Role)</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold text-sm shadow-sm shadow-blue-500/20">
                                    AD
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">Administrator</p>
                                    <p class="text-xs text-slate-400">Terdaftar: Jun 2026</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-slate-500">admin@roadcare.id</td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                Super Admin
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="px-2.5 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100 border border-slate-200 rounded-lg transition-colors">
                                    Edit
                                </button>
                                <button class="px-2.5 py-1.5 text-xs font-medium text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 rounded-lg transition-colors">
                                    Suspend
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection