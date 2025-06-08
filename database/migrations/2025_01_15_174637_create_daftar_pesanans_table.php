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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('kategori_pesanan');
            // ✅ TAMBAHKAN KOLOM YANG HILANG ✅
            $table->bigInteger('kelola_makanan_id')->unsigned()->nullable();
            $table->dateTime('tanggal_pesanan');
            $table->integer('jumlah_pesanan');
            $table->date('tanggal_pengiriman');
            $table->time('waktu_pengiriman');
            $table->text('lokasi_pengiriman');
            $table->string('nomor_telepon');
            $table->text('pesan')->nullable();
            $table->string('opsi_pengiriman');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status_pengiriman', ['diproses', 'dikirim', 'diterima', 'dibatalkan']);
            $table->enum('status_pembayaran', ['pending', 'paid', 'failed']);
            
            // ✅ TAMBAHKAN 4 KOLOM PEMBATALAN BARU ✅
            $table->text('catatan_pembatalan')->nullable()
                ->comment('Alasan pembatalan pesanan (dari admin atau user)');
            $table->timestamp('cancelled_at')->nullable()
                ->comment('Tanggal dan waktu pembatalan');
            $table->unsignedBigInteger('cancelled_by')->nullable()
                ->comment('ID user yang membatalkan (admin atau user)');
            $table->enum('cancelled_by_type', ['admin', 'user'])->nullable()
                ->comment('Jenis pembatal: admin atau user');
                
            $table->timestamps();
            
            // ✅ TAMBAHKAN FOREIGN KEYS ✅
            $table->foreign('kelola_makanan_id')
                  ->references('id')->on('kelola_makanans')
                  ->onDelete('set null');
            $table->foreign('cancelled_by')
                  ->references('id')->on('users')
                  ->onDelete('set null');
                  
            // ✅ TAMBAHKAN INDEXES UNTUK PERFORMA ✅
            $table->index('kelola_makanan_id', 'idx_kelola_makanan_id');
            $table->index(['status_pengiriman', 'cancelled_at'], 'idx_status_cancelled');
            $table->index('cancelled_by', 'idx_cancelled_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('daftar_pesanans');
    }
};