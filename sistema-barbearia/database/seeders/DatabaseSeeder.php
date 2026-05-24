<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar os tipos de usuário (administrador e cliente)
        $adminType = UserType::firstOrCreate(['name' => 'administrador']);
        UserType::firstOrCreate(['name' => 'cliente']);

        //  2. Criar um usuário administrador
        User::firstOrCreate(
            ['email' => 'admin@barber.com'], 
            [
                'name' => 'Administrador Central',
                'password' => Hash::make('senha123'),
                'user_type_id' => $adminType->id,
            ]
        );
    }
}