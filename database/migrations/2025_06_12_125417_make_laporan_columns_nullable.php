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
        Schema::table('laporans', function (Blueprint $table) {
            // ✅ UBAH KOLOM ADMIN DAN DESKRIPSI MENJADI NULLABLE ✅
            $table->string('admin')->nullable()->change();
            $table->text('deskripsi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            // ✅ KEMBALIKAN KE NOT NULL JIKA ROLLBACK ✅
            $table->string('admin')->nullable(false)->change();
            $table->text('deskripsi')->nullable(false)->change();
        });
    }
};
