<?php

namespace App\Services;

use App\Models\Shop;
use Illuminate\Support\Collection;

class ProductReportService
{
    /**
     * Retourne les produits les plus vendus
     * uniquement à partir des ventes terminées.
     */
    public function getTopSellingProducts(
        Shop $shop,
        int $limit = 5
    ): Collection {
        return $shop->products()
            ->withSum([
                'saleItems as sold_quantity' => function ($query) {
                    $query->whereHas('sale', function ($saleQuery) {
                        $saleQuery->where('status', 'completed');
                    });
                },
            ], 'quantity')
            ->withSum([
                'saleItems as sold_revenue' => function ($query) {
                    $query->whereHas('sale', function ($saleQuery) {
                        $saleQuery->where('status', 'completed');
                    });
                },
            ], 'total')
            ->orderByDesc('sold_quantity')
            ->limit($limit)
            ->get();
    }
}