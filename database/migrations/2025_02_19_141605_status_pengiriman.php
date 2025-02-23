<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('statuspengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembeli');
            $table->string('nama_produk');
            $table->date('tanggal_transaksi');
            $table->string('status_pengiriman');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('statuspengiriman');
    }
};
