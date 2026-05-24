<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    // Método para listar clientes (Necessário para a rota GET /api/clients)
    public function index()
    {
        // Retorna todos os clientes com os dados do usuário relacionado
        $clients = Client::with('user')->get();
        return response()->json($clients, 200);
    }

    // Método para cadastrar cliente
    public function store(Request $request)
    {
        // 1. Validar os dados recebidos do cliente
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
        ]);

        // 2. Iniciar uma transação
        DB::beginTransaction();

        try {
            // Buscar o tipo 'cliente' para obter o ID correspondente
            $clientType = UserType::where('name', 'cliente')->firstOrFail();

            // 3. Criar o usuário na tabela USERS
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type_id' => $clientType->id,
            ]);

            // 4. Criar o cliente na tabela CLIENTS
            Client::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
            ]);

            DB::commit();

            return response()->json(['message' => 'Cliente cadastrado com sucesso!'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Erro ao cadastrar cliente.', 
                'error' => $e->getMessage()
            ], 500);
        }
    }
}