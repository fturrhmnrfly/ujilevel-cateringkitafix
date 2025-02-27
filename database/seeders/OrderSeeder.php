<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'order_id' => 'ORD123456789',
            'user_id' => 1, // Assuming you have users table with ID 1
            'total_amount' => 150000,
            'status' => 'pending',
            'payment_deadline' => now()->addHours(24),
        ]);
    }
}