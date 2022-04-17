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
        OrderStatus::create(['name' => 'Na fila']);
        OrderStatus::create(['name' => 'Pedido efetuado']);
        OrderStatus::create(['name' => 'Entregue ao Tiago']);
        OrderStatus::create(['name' => 'Finalizado']);
        OrderStatus::create(['name' => 'Cancelado']);
    }
}
