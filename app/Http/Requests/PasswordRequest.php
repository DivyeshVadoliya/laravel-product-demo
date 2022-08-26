<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'oldPassword' => ['required', 'min:8', 'max:30'],
            'newPassword' => ['required', 'min:8', 'max:30'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ];
    }
}
