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
        // Buat tabel registers
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        // Ubah kolom 'name' di tabel users menjadi nullable
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus perubahan pada tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change(); // Mengembalikan seperti awal (wajib diisi)
        });

        // Hapus tabel registers jika rollback
        Schema::dropIfExists('registers');
    }
};
