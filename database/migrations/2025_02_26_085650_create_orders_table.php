<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('order_number');
            $table->foreignId('user_id')->constrained();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_cost', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->text('shipping_address');
            $table->string('phone_number');
            $table->text('notes')->nullable();
            $table->dateTime('delivery_date');
            $table->enum('payment_method', ['bca', 'dana', 'gopay', 'cod']);
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_proof')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};