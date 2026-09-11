<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Récupérer les catégories d'une boutique
     */
    public function getByShop(Shop $shop): Collection
    {
        return $shop->categories()
            ->latest()
            ->get();
    } 

    /**
     * Créer une catégorie
     */
    public function create(Shop $shop, array $data): Category
    {
        return $shop->categories()->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);
    }

    /**
     * Modifier une catégorie.
     */
    public function update(Category $category, array $data): Category
    {
        $category->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        return $category->refresh();
    }

    /**
     * Supprimer une catégorie.
     */
    public function delete(Category $category): void
    {
        $category->delete();
    }
}