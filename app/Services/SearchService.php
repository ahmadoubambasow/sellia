<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Support\Collection;

class SearchService
{
    /**
     * Recherche globale dans la boutique.
     */
    public function search(Shop $shop, string $term): array
    {
        $term = trim($term);

        if ($term === '') {
            return [
                'products' => collect(),
                'customers' => collect(),
                'sales' => collect(),
                'categories' => collect(),
            ];
        }

        $search = '%' . $term . '%';

        return [
            'products' => $this->searchProducts($shop, $search),
            'customers' => $this->searchCustomers($shop, $search),
            'sales' => $this->searchSales($shop, $search),
            'categories' => $this->searchCategories($shop, $search),
        ];
    }

    public function suggestions(Shop $shop, string $term): array
    {
        $term = trim($term);

        if ($term === '') {
            return [
                'products' => collect(),
                'customers' => collect(),
                'sales' => collect(),
                'categories' => collect(),
            ];
        }

        $search = '%' . $term . '%';

        return [
            'products' => $this->searchProducts($shop, $search)->take(4),
            'customers' => $this->searchCustomers($shop, $search)->take(4),
            'sales' => $this->searchSales($shop, $search)->take(4),
            'categories' => $this->searchCategories($shop, $search)->take(4),
        ];
    }

    private function searchProducts(
        Shop $shop,
        string $search
    ): Collection {
        return Product::query()
            ->where('shop_id', $shop->id)
            ->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', $search)
                    ->orWhere('sku', 'like', $search);
            })
            ->orderBy('name')
            ->limit(8)
            ->get();
    }

    private function searchCustomers(
        Shop $shop,
        string $search
    ): Collection {
        return Customer::query()
            ->where('shop_id', $shop->id)
            ->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', $search)
                    ->orWhere('phone', 'like', $search)
                    ->orWhere('email', 'like', $search);
            })
            ->orderBy('name')
            ->limit(8)
            ->get();
    }

    private function searchSales(
        Shop $shop,
        string $search
    ): Collection {
        return Sale::query()
            ->where('shop_id', $shop->id)
            ->where('reference', 'like', $search)
            ->with('customer')
            ->latest('sold_at')
            ->limit(8)
            ->get();
    }

    private function searchCategories(
        Shop $shop,
        string $search
    ): Collection {
        return Category::query()
            ->where('shop_id', $shop->id)
            ->where('name', 'like', $search)
            ->orderBy('name')
            ->limit(8)
            ->get();
    }
}