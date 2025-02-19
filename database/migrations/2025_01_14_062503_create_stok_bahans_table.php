<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stok_bahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bahan');
            $table->string('stok_tersedia');
            $table->date('tanggal_ditambahkan');
            $table->date('tanggal_kadaluarsa');
            $table->enum('status', ['tersedia', 'kosong']);
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_bahans');
    }
};
