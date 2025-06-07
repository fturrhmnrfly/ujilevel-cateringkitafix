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
        
        Schema::table('daftar_pesanans', function (Blueprint $table) {
            // Tambahkan kolom yang hilang dari struktur asli
            if (!Schema::hasColumn('daftar_pesanans', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('nama_pelanggan')->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('daftar_pesanans', 'kelola_makanan_id')) {
                $table->bigInteger('kelola_makanan_id')->unsigned()->nullable()->after('kategori_pesanan');
            }
            
            // Update enum values sesuai SQL dump
            $table->enum('status_pengiriman', ['diproses', 'dikirim', 'diterima', 'dibatalkan'])->change();
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed'])->change();
            
            // Tambahkan index
            $table->index('kelola_makanan_id', 'idx_kelola_makanan_id');
        });
    }

    public function down()
    {
        Schema::table('daftar_pesanans', function (Blueprint $table) {
            $table->dropIndex('idx_kelola_makanan_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'kelola_makanan_id']);
        });
        
        Schema::dropIfExists('daftar_pesanans');
    }
};