<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'roll' => ['required', 'in:admin,seller,buyer'],
        ];
    }
}
