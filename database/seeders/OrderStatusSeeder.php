<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create(['status' => 'Pedido solicitado']);
        OrderStatus::create(['status' => 'Pedido efetuado']);
        OrderStatus::create(['status' => 'Pedido entregue']);
        OrderStatus::create(['status' => 'Pedido cancelado']);
    }
}
