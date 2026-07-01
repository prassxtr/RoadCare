<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();

            // Nomor laporan
            $table->string('kode_laporan')->unique();

            // Data pelapor
            $table->string('nama_pelapor');
            $table->string('no_hp')->nullable();

            // Jenis laporan
            $table->enum('kategori', [
                'Jalan Rusak',
                'Banjir',
                'Tanah Longsor'
            ]);

            // Lokasi
            $table->string('lokasi');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Deskripsi
            $table->text('deskripsi');

            // Foto bukti
            $table->string('foto')->nullable();

            // Prioritas
            $table->enum('prioritas', [
                'Rendah',
                'Sedang',
                'Tinggi'
            ])->default('Sedang');

            // Status
            $table->enum('status', [
                'Menunggu Verifikasi',
                'Sedang Diproses',
                'Selesai Ditangani'
            ])->default('Menunggu Verifikasi');

            // Admin yang menangani
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};