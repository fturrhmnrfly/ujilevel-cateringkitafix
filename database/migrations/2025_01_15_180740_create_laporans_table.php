<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_laporan');
            $table->string('laporan');
            $table->text('deskripsi');
            $table->decimal('total', 12, 2)->default(0);
            $table->string('admin');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporans');
    }
};
