<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'kategori',
        'deskripsi',
        'foto',
        'latitude',
        'longitude',
        'alamat',
        'urgensi',
        'status',
        'user_id',
        'admin_id',
        'catatan_admin',
    ];

    // Relasi ke user pelapor
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke admin yang menangani
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}