<?php

namespace App\Services;

use App\Models\Shop;
use Illuminate\Support\Collection;

class StockReportService
{
    /**
     * Retourne les produits actifs dont le stock
     * est inférieur ou égal au seuil configuré.
     */
    public function getLowStockProducts(
        Shop $shop,
        int $limit = 5
    ): Collection {
        return $shop->products()
            ->where('is_active', true)
            ->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->orderBy('stock_quantity')
            ->limit($limit)
            ->get();
    }

    /**
     * Retourne les produits actifs actuellement en rupture.
     */
    public function getOutOfStockProducts(
        Shop $shop,
        int $limit = 5
    ): Collection {
        return $shop->products()
            ->where('is_active', true)
            ->where('stock_quantity', 0)
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }

    /**
     * Retourne les statistiques globales du stock.
     */
    public function getSummary(Shop $shop): array
    {
        $products = $shop->products()
            ->where('is_active', true);

        return [
            'total_products' => (clone $products)->count(),

            'low_stock' => (clone $products)
                ->whereColumn(
                    'stock_quantity',
                    '<=',
                    'low_stock_threshold'
                )
                ->count(),

            'out_of_stock' => (clone $products)
                ->where('stock_quantity', 0)
                ->count(),
        ];
    }
}