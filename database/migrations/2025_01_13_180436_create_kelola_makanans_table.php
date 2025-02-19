<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('kelola_makanans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_makanan');
        $table->string('kategori');
        $table->decimal('harga', 10, 2);
        $table->string('status');
        $table->text('deskripsi')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_makanans');
    }
};
