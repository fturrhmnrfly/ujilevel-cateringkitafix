<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationAdminsTable extends Migration
{
    public function up()
{
    Schema::create('notifications_admin', function (Blueprint $table) {
        $table->id();
        $table->foreignId('admin_id')->constrained('users');
        $table->string('title');
        $table->text('message');
        $table->string('icon_type')->default('box');
        $table->string('order_id')->nullable();
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}
}