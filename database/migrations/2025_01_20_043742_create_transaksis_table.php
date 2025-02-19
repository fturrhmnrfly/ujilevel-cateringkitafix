<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_admin');
            $table->string('nama_pelanggan');
            $table->date('tanggal_transaksi');
            $table->string('id_transaksi')->unique();
            $table->string('jenis_tindakan');
            $table->text('deskripsi_tindakan');
            $table->enum('status_transaksi', ['Selesai', 'Dibatalkan']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
