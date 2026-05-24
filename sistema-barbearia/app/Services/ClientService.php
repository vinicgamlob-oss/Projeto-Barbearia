<?php

namespace App\Services;

use App\Models\User;
use App\Models\Client;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClientService
{
    public function createClient(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Busca o ID do tipo cliente
            $clientType = UserType::where('name', 'cliente')->firstOrFail();

            // Cria o usuário para acesso à API
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_type_id' => $clientType->id,
            ]);

            // Cria o perfil do cliente vinculado ao usuário
            return Client::create([
                'user_id' => $user->id,
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
            ]);
        });
    }
}