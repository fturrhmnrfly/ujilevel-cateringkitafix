<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daftar_pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('nama_pelanggan');
            $table->string('kategori_pesanan');
            $table->dateTime('tanggal_pesanan');
            $table->integer('jumlah_pesanan');
            $table->date('tanggal_pengiriman');
            $table->time('waktu_pengiriman');
            $table->text('lokasi_pengiriman');
            $table->string('nomor_telepon');
            $table->text('pesan')->nullable();
            $table->string('opsi_pengiriman');
            $table->decimal('total_harga', 10, 2);
            $table->string('status_pengiriman');
            $table->string('status_pembayaran');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daftar_pesanans');
    }
};