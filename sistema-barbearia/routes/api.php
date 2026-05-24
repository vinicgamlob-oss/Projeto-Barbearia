<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SchedulingController; // <-- Adicionado
use App\Http\Controllers\AdminController;

// Rotas Públicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/clients', [ClientController::class, 'store']); // Mudei para /clients seguindo o padrão REST

// Rotas Protegidas
Route::middleware('auth:sanctum')->group(function () {
    
    // Admin
    Route::post('/admin/register', [AdminController::class, 'store']); 
    
    // Agendamentos
    Route::get('/schedulings', [SchedulingController::class, 'index']);
    Route::post('/schedulings', [SchedulingController::class, 'store']);

    // Clientes (Listagem)
    Route::get('/clients', [ClientController::class, 'index']);
});