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
    Schema::create('daftar_pesanans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pesanan');
        $table->string('nama_pelanggan');
        $table->date('tanggal_pesanan');
        $table->string('jumlah_pesanan');
        $table->date('tanggal_acara');
        $table->text('lokasi_pengiriman');
        $table->decimal('total_harga', 10, 2);
        $table->enum('status_pengiriman', ['diproses', 'pending', 'selesai']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_pesanans');
    }
};
