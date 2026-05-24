<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchedulingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // O middleware da rota cuidará da proteção por token
    }

    public function rules(): array
    {
        return [
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}