<?php

namespace Database\Seeders;

use App\Models\PackageStatus;
use Illuminate\Database\Seeder;

class PackageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageStatus::create(['status' => 'Pacote comprado']);
        PackageStatus::create(['status' => 'Pacote em transito']);
        PackageStatus::create(['status' => 'Pacote entregue ao Tiago']);
        PackageStatus::create(['status' => 'Pacote entregue ao comprador']);
    }
}
