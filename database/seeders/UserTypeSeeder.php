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
        UserType::create(['name' => 'Administrador']);
        UserType::create(['name' => 'Gerenciador']);
        UserType::create(['name' => 'Usuário']);
    }
}
