<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('kategori');
        $table->text('deskripsi')->nullable();
        $table->string('foto')->nullable();
        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);
        $table->string('alamat')->nullable();
        $table->enum('status', ['pending', 'verified', 'in_progress', 'resolved'])->default('pending');
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->timestamps();
    });
}   

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
