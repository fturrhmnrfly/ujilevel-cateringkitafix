<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('user_id')->constrained();
            $table->decimal('total_amount', 10, 2);
            $table->string('status');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->timestamp('payment_deadline');
            $table->timestamps();
        });
    }
};