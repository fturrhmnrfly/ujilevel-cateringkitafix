<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_admin')->nullable();
            $table->string('nama_pelanggan');
            $table->dateTime('tanggal_transaksi');
            $table->string('id_transaksi')->unique();
            $table->string('jenis_tindakan');
            $table->text('deskripsi_tindakan');
            $table->decimal('total_harga', 12, 2);
            $table->string('status_transaksi');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
