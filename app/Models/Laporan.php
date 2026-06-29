<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans'; // atau 'laporan' sesuai nama tabel

    protected $fillable = [
        'kategori',
        'deskripsi',
        'foto',
        'latitude',
        'longitude',
        'alamat',
        'status',
        'user_id',
    ];

    // Relasi ke User (opsional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
