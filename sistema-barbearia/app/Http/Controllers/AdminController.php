<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        // 1. Obter o usuário logado
        $currentUser = $request->user();

        // 2. Verificar se o usuário logado é um administrador
        // Buscamos o tipo 'administrador' para comparar o ID
        $adminType = UserType::where('name', 'administrador')->first();

        if ($currentUser->user_type_id !== $adminType->id) {
            return response()->json(['message' => 'Acesso negado. Apenas administradores podem realizar essa ação.'], 403);
        }

        // 3. Validar os dados recebidos para criar o novo administrador
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // 4. Criar o novo usuário com o tipo 'administrador'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => $adminType->id,
        ]);

        return response()->json(['message' => 'Novo administrador cadastrado com sucesso!'], 21);
    }
}