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
        PackageStatus::create(['name' => 'Pacote comprado']);
        PackageStatus::create(['name' => 'Pacote em transito']);
        PackageStatus::create(['name' => 'Pacote entregue ao Tiago']);
        PackageStatus::create(['name' => 'Pacote finalizado']);
        PackageStatus::create(['name' => 'Pacote Cancelado']);
    }
}
