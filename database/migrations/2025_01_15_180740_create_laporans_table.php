<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('laporan'); // Nama laporan
            $table->string('jenis_laporan'); // Jenis laporan
            $table->date('tanggal'); // Tanggal
            $table->string('admin'); // Admin
            $table->text('deskripsi')->nullable(); // Deskripsi
            $table->enum('status', ['Selesai', 'Pending'])->default('Pending'); // Status
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('laporans');
    }
};
