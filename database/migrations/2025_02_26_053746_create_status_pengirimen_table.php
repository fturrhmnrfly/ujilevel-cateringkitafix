<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_pengirimen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembeli');
            $table->string('nama_produk');
            $table->date('tanggal_transaksi');
            $table->enum('status_pengiriman', ['Dikirim', 'Selesai', 'Batal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pengirimen');
    }
};
