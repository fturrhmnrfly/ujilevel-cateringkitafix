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
    {        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained('daftar_pesanans')->onDelete('cascade');
            $table->string('order_number');
            $table->tinyInteger('quality_rating')->unsigned()->comment('Rating kualitas produk (1-5)');
            $table->tinyInteger('delivery_rating')->unsigned()->comment('Rating kecepatan pengiriman (1-5)');
            $table->tinyInteger('service_rating')->unsigned()->comment('Rating pelayanan (1-5)');
            $table->decimal('average_rating', 2, 1)->comment('Rating rata-rata');
            $table->text('review_text')->nullable()->comment('Ulasan tekstual (maksimal 500 karakter)');
            $table->json('photos')->nullable()->comment('Array path foto review');
            $table->enum('status', ['active', 'hidden', 'reported'])->default('active');
            $table->boolean('is_verified')->default(false)->comment('Apakah review sudah diverifikasi admin');
            $table->timestamp('reviewed_at')->nullable()->comment('Waktu review dibuat');
            $table->timestamps();
            
            // Indexes
            $table->unique(['user_id', 'order_id'], 'unique_user_order_review');
            $table->index('average_rating', 'reviews_average_rating_index');
            $table->index('status', 'reviews_status_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
