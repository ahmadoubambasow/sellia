<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_method' => [
                'required',
                'string',
                Rule::in([
                    'cash',
                    'wave',
                    'orange_money',
                    'card',
                    'other',
                ]),
            ],

            'paid_at' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' =>
                'Veuillez saisir le montant du paiement.',

            'amount.numeric' =>
                'Le montant doit être un nombre.',

            'amount.min' =>
                'Le montant doit être supérieur à zéro.',

            'payment_method.required' =>
                'Veuillez sélectionner un mode de paiement.',

            'payment_method.in' =>
                'Le mode de paiement sélectionné est invalide.',

            'paid_at.date' =>
                'La date du paiement est invalide.',

            'notes.max' =>
                'Les notes ne peuvent pas dépasser 2 000 caractères.',
        ];
    }

    public function attributes(): array
    {
        return [
            'amount' => 'montant',
            'payment_method' => 'mode de paiement',
            'paid_at' => 'date du paiement',
            'notes' => 'notes',
        ];
    }
}