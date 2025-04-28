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
            $table->datetime('tanggal_pesanan');
            $table->integer('jumlah_pesanan');
            $table->text('lokasi_pengiriman');
            $table->string('nomor_telepon');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pengiriman', ['diproses', 'dikirim', 'selesai', 'batal']);
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed']);
            // Update this line to include all shipping options
            $table->enum('opsi_pengiriman', ['self', 'instant', 'regular', 'economy']);
            $table->text('pesan_untuk_penjual')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daftar_pesanans');
    }
};
