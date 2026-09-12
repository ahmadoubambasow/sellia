<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Autoriser la requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     */
    public function rules(): array
    {
        return [
            'customer_id' => [
                'nullable',
                'integer',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.product_id' => [
                'required',
                'integer',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'amount_paid' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'payment_method' => [
                'nullable',
                'string',
                'in:cash,wave,orange_money,card,other',
            ],
        ];
    }

    /**
     * Messages de validation en français.
     */
    public function messages(): array
    {
        return [
            'items.required' => 'La vente doit contenir au moins un produit.',
            'items.min' => 'La vente doit contenir au moins un produit.',
            'items.*.product_id.required' => 'Veuillez sélectionner un produit.',
            'items.*.quantity.required' => 'Veuillez indiquer une quantité.',
            'items.*.quantity.min' => 'La quantité doit être supérieure à zéro.',
            'discount.numeric' => 'La remise doit être un montant valide.',
            'discount.min' => 'La remise ne peut pas être négative.',
            'notes.max' => 'Les notes ne peuvent pas dépasser 2000 caractères.',
            'amount_paid.numeric' => 'Le montant payé doit être un montant valide.',
            'amount_paid.min' => 'Le montant payé ne peut pas être négatif.',
            'payment_method.in' => 'Le mode de paiement sélectionné est invalide.',
        ];
    }

    /**
     * Noms des champs en français.
     */
    public function attributes(): array
    {
        return [
            'customer_id' => 'client',
            'items' => 'produits',
            'items.*.product_id' => 'produit',
            'items.*.quantity' => 'quantité',
            'discount' => 'remise',
            'notes' => 'notes',
            'amount_paid' => 'montant payé',
            'payment_method' => 'mode de paiement',
        ];
    }
}