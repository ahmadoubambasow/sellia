<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'category_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:100',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock_quantity' => [
                'required',
                'integer',
                'min:0',
            ],

            'low_stock_threshold' => [
                'required',
                'integer',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'catégorie',
            'name' => 'nom du produit',
            'sku' => 'référence',
            'purchase_price' => "prix d'achat",
            'selling_price' => 'prix de vente',
            'stock_quantity' => 'quantité en stock',
            'low_stock_threshold' => 'seuil de stock faible',
            'description' => 'description',
            'is_active' => 'statut',
        ];
    }
}