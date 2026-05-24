<?php

namespace App\Http\Controllers;

use App\Models\Scheduling;
use App\Models\Client;
use App\Models\User;
use App\Models\UserType;
use App\Mail\NewSchedulingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SchedulingController extends Controller
{
    // Listar agendamentos (todos para admin, apenas os próprios para cliente)
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Verificar se o usuário é cliente ou administrador
        $client = Client::where('user_id', $user->id)->first();
        $adminType = UserType::where('name', 'administrador')->first();
        $isAdmin = $user->user_type_id === $adminType->id;

        if ($client && !$isAdmin) {
            $schedulings = Scheduling::where('client_id', $client->id)->get();
        } else {
            $schedulings = Scheduling::with('client.user')->get();
        }

        return response()->json($schedulings);
    }

    // Criar um novo agendamento (apenas para clientes)
    public function store(Request $request)
    {
        // 1. Identificar o cliente logado
        $user = $request->user();
        $client = Client::where('user_id', $user->id)->first();

        if (!$client) {
            return response()->json(['message' => 'Apenas clientes podem criar agendamentos.'], 403);
        }

        // 2. Validar os dados
        $request->validate([
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
        ]);

        // 3. Criar o agendamento
        $scheduling = Scheduling::create([
            'client_id' => $client->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // 4. Notificar todos os administradores (user_type_id = 1)
        $admins = User::where('user_type_id', 1)->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewSchedulingNotification($scheduling));
        }

        // 5. Retorno de sucesso (Status 201)
        return response()->json([
            'message' => 'Agendamento realizado com sucesso e administradores notificados!',
            'data' => $scheduling
        ], 201);
    }
}