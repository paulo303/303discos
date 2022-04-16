<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'         => 'Chochi',
            'email'        => 'paulocavalcanti303@gmail.com',
            'user_type_id' => 1,
            'password'     => bcrypt('123456789'),
        ]);

        User::create([
            'name'         => 'Tiago Santos',
            'email'        => 'engtiagosantos@gmail.com',
            'user_type_id' => 2,
            'password'     => bcrypt('123456789'),
        ]);
    }
}
