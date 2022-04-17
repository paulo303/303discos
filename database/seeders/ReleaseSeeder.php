<?php

namespace Database\Seeders;

use App\Models\Release;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Release::create([
            'label_id' => 3,
            'release_num' => '001',
            'cat_num' => '4x4x1',
        ]);

        Release::create([
            'label_id' => 3,
            'release_num' => '002',
            'cat_num' => '4x4x2',
        ]);

        Release::create([
            'label_id' => 4,
            'release_num' => '001',
            'cat_num' => '76B 001',
        ]);
    }
}
