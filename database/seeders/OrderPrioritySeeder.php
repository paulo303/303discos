<?php

namespace Database\Seeders;

use App\Models\OrderPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderPriority::create(['name' => 'Baixa']);
        OrderPriority::create(['name' => 'Média']);
        OrderPriority::create(['name' => 'Alta']);
    }
}
