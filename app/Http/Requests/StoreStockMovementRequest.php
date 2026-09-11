<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStockMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'type' => [
                'required',
                Rule::in([
                    'entry',
                    'exit',
                    'adjustment',
                ]),
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:255',
            ],

            'reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'product_id' => 'produit',
            'type' => 'type de mouvement',
            'quantity' => 'quantité',
            'reason' => 'motif',
            'reference' => 'référence',
            'notes' => 'notes',
        ];
    }
}