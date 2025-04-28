<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->string('username_karyawan')->unique();
            $table->string('posisi');
            $table->string('kontak');
            $table->date('tanggal_bergabung');
            $table->enum('status', ['Aktif', 'Cuti', 'Nonaktif']);
            $table->string('keahlian');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};
