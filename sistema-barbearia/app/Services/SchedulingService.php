<?php

namespace App\Services;

use App\Models\Scheduling;
use Illuminate\Support\Facades\Auth;

class SchedulingService
{
    public function createScheduling(array $data)
    {
        // Garante que o agendamento pertence ao cliente logado
        $client = Auth::user()->client; 

        if (!$client) {
            throw new \Exception('Usuário autenticado não possui um perfil de cliente.', 403);
        }

        return Scheduling::create([
            'client_id' => $client->id,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }
}