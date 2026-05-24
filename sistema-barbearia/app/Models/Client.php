<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    // Define quais campos podem ser preenchidos via "create"
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
    ];

    // Define o relacionamento (Um cliente pertence a um usuário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}