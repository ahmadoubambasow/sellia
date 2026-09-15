<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StockThresholdReached extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Product $product,
        private readonly int $stockBefore,
        private readonly int $stockAfter,
    ) {
    }

    /**
     * Canaux utilisés par la notification.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Type personnalisé enregistré en base.
     */
    public function databaseType(object $notifiable): string
    {
        return 'stock-threshold-reached';
    }

    /**
     * Données enregistrées dans la colonne data.
     */
    public function toArray(object $notifiable): array
    {
        $isOutOfStock = $this->stockAfter === 0;

        return [
            'title' => $isOutOfStock
                ? 'Rupture de stock'
                : 'Stock faible',

            'message' => $isOutOfStock
                ? "{$this->product->name} est actuellement en rupture de stock."
                : "Le stock de {$this->product->name} est arrivé à {$this->stockAfter} unité(s).",

            'product_id' => $this->product->id,

            'product_name' => $this->product->name,

            'stock_before' => $this->stockBefore,

            'stock_after' => $this->stockAfter,

            'threshold' => $this->product->low_stock_threshold,

            'severity' => $isOutOfStock
                ? 'critical'
                : 'warning',

            'url' => route('products.edit', $this->product),
        ];
    }
}