<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // 1. ESSA LINHA PRECISA ESTAR AQUI!
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    // 2. ADICIONE O 'HasApiTokens' AQUI DENTRO DO USE:
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relacionamento: Um Usuário pertence a um Tipo de Usuário.
     */
    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class);
    }
}