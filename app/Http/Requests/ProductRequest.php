<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        $commonRules = [
            'name' => ['required', 'max:30'],
            'status' => ['required', 'in:active,inactive'],
            'category' => ['required', 'array', 'min:1'],
        ];

        if($this->route('product')){
            $uniqueRules = ['image' => ['sometimes', 'required', 'image', 'mimes:jpeg,png,jpg,gif']];
        }
        else{
            $uniqueRules = ['image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif']];
        }

        return array_merge($commonRules, $uniqueRules);
    }
}
