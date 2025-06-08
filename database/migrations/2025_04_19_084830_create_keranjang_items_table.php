<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keranjang_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('kelola_makanan_id')->nullable();
            $table->string('nama_produk');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->string('image');
            $table->timestamps();

            $table->foreign('kelola_makanan_id')
                  ->references('id')->on('kelola_makanans')
                  ->onDelete('set null');

            $table->index('kelola_makanan_id', 'idx_kelola_makanan_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang_items');
    }
};
