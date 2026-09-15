<?php

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Models\Product;
use App\Models\Shop;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Notifications\StockThresholdReached;
use RuntimeException;

class StockMovementService
{

    public function getByShop(Shop $shop): Collection
    {
        return $shop->stockMovements()
            ->with([
                'product',
                'user',
            ])
            ->latest()
            ->get();
    }

    public function create(
        Shop $shop,
        User $user,
        array $data
    ): StockMovement {
        return DB::transaction(function () use (
            $shop,
            $user,
            $data
        ) {
            $product = $shop->products()
                ->whereKey($data['product_id'])
                ->lockForUpdate()
                ->first();

            abort_unless($product, 404);

            $quantity = (int) $data['quantity'];
            $type = $data['type'];

            $stockBefore = $product->stock_quantity;

            $stockAfter = $this->calculateStockAfter(
                $stockBefore,
                $type,
                $quantity
            );

            $this->validateStock(
                $stockBefore,
                $stockAfter,
                $quantity,
                $type
            );

            $product->update([
                'stock_quantity' => $stockAfter,
            ]);

            $this->notifyStockThreshold(
                product: $product,
                stockBefore: $stockBefore,
                stockAfter: $stockAfter,
            );
            return $shop->stockMovements()->create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'type' => $type,
                'quantity' => $quantity,
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,
                'reason' => $data['reason'] ?? null,
                'reference' => $data['reference'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }


    private function calculateStockAfter(
        int $stockBefore,
        string $type,
        int $quantity
    ): int {
        return match ($type) {
            'entry' => $stockBefore + $quantity,

            'exit' => $stockBefore - $quantity,

            'adjustment' => $quantity,

            default => throw new RuntimeException(
                'Type de mouvement de stock invalide.'
            ),
        };
    }

    private function validateStock(
        int $stockBefore,
        int $stockAfter,
        int $quantity,
        string $type
    ): void {
        if ($quantity <= 0) {
            throw new RuntimeException(
                'La quantité doit être supérieure à zéro.'
            );
        }

        if ($type === 'exit' && $stockAfter < 0) {
            throw new InsufficientStockException(
                $stockBefore,
                $quantity
            );
        }
    }

    private function notifyStockThreshold(
        Product $product,
        int $stockBefore,
        int $stockAfter
    ): void {
        $threshold = $product->low_stock_threshold;

        /*
        * 1. Le produit entre dans la zone de stock faible.
        *
        * Exemple :
        * 6 → 5 avec seuil 5
        */
        $reachedThreshold =
            $stockBefore > $threshold &&
            $stockAfter > 0 &&
            $stockAfter <= $threshold;

        /*
        * 2. Le produit passe en rupture.
        *
        * On notifie même s'il était déjà sous le seuil.
        *
        * Exemple :
        * 5 → 0
        * 2 → 0
        * 1 → 0
        */
        $outOfStock =
            $stockBefore > 0 &&
            $stockAfter === 0;

        if (! $reachedThreshold && ! $outOfStock) {
            return;
        }

        $product->shop->user->notify(
            new StockThresholdReached(
                product: $product,
                stockBefore: $stockBefore,
                stockAfter: $stockAfter,
            )
        );
    }
}