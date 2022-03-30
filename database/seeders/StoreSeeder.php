<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name' => 'Stay Up Forever',
            'link' => 'https://www.stayupforever.com',
            'logo' => 'images/stores/stay-up-forever.jpg',
        ]);

        Store::create([
            'name' => 'Biri - Discogs',
            'link' => 'https://www.discogs.com/seller/Victo/profile',
            'logo' => 'images/stores/biri-discogs.png',
        ]);
    }
}
