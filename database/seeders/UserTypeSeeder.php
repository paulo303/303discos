<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::create(['type' => 'Administrador']);
        UserType::create(['type' => 'Gerenciador']);
        UserType::create(['type' => 'Usuário']);
    }
}
