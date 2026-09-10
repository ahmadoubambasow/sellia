<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'currency' => [
                'required',
                'string',
                'in:XOF',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom de la boutique',
            'description' => 'description',
            'phone' => 'téléphone',
            'address' => 'adresse',
            'currency' => 'devise',
        ];
    }
}