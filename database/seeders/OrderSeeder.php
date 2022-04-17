<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'created_by' => 1,
            'store_id' => 1,
            'release_id' => 1,
            'order_status_id' => 2,
            'package_status_id' => 1,
            'order_priority_id' => 1,
            'price' => 9.9,
            'currency_id' => 1,
        ]);

        Order::create([
            'user_id' => 1,
            'created_by' => 2,
            'store_id' => 2,
            'release_id' => 2,
            'order_status_id' => 1,
            'order_priority_id' => 2,
            'price' => 9.9,
            'currency_id' => 2,
        ]);

        Order::create([
            'user_id' => 2,
            'created_by' => 2,
            'store_id' => 1,
            'release_id' => 3,
            'order_status_id' => 1,
            'order_priority_id' => 3,
            'price' => 9.9,
            'currency_id' => 3,
        ]);
    }
}
