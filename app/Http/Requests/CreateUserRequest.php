<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:50',
                            Rule::unique('users')->ignore($this->user)],
                'roll' => ['required', 'in:admin,seller,buyer'],
                'status' => ['required', 'in:active,inactive'],
                'password' =>['confirmed', Rules\Password::defaults(),
                            Rule::when('! password', 'nullable', 'required')],
        ];
    }
}
