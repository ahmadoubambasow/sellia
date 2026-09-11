<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function getByShop(Shop $shop): Collection
    {
        return $shop->products()
            ->with('category')
            ->latest()
            ->get();
    }

    public function create(Shop $shop, array $data): Product
    {
        $categoryId = $data['category_id'] ?? null;

        $this->ensureCategoryBelongsToShop($categoryId, $shop);

        return $shop->products()->create([
            'category_id' => $categoryId,
            'name' => $data['name'],
            'sku' => $data['sku'] ?? null,
            'purchase_price' => $data['purchase_price'],
            'selling_price' => $data['selling_price'],
            'stock_quantity' => $data['stock_quantity'],
            'low_stock_threshold' => $data['low_stock_threshold'],
            'description' => $data['description'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);
    }

    public function update(
        Product $product,
        array $data
    ): Product {
        $categoryId = $data['category_id'] ?? null;

        $this->ensureCategoryBelongsToShop(
            $categoryId,
            $product->shop
        );

        $product->update([
            'category_id' => $categoryId,
            'name' => $data['name'],
            'sku' => $data['sku'] ?? null,
            'purchase_price' => $data['purchase_price'],
            'selling_price' => $data['selling_price'],
            'stock_quantity' => $data['stock_quantity'],
            'low_stock_threshold' => $data['low_stock_threshold'],
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? false,
        ]);

        return $product->refresh();
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    private function ensureCategoryBelongsToShop(
        ?int $categoryId,
        Shop $shop
    ): void {
        if ($categoryId === null) {
            return;
        }

        abort_unless(
            $shop->categories()
                ->whereKey($categoryId)
                ->exists(),
            404
        );
    }
}