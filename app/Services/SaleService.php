<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;
use App\Exceptions\InvalidDiscountException;
use App\Exceptions\InvalidPaymentException;
use App\Exceptions\SaleAlreadyCancelledException;

class SaleService
{
    public function __construct(
        private readonly StockMovementService $stockMovementService
    ) {
    }
    public function getByShop(Shop $shop): Collection
    {
        return $shop->sales()
            ->with([
                'customer',
                'user',
                'items.product',
            ])
            ->latest('sold_at')
            ->get();
    }

    public function create(
        Shop $shop,
        User $user,
        array $data
    ): Sale {
        return DB::transaction(function () use (
            $shop,
            $user,
            $data
        ) {
            $customer = $this->getCustomer(
                $shop,
                $data['customer_id'] ?? null
            );

            $items = $this->prepareItems(
                $shop,
                $data['items'] ?? []
            );

            $subtotal = $this->calculateSubtotal($items);

            $discount = (float) ($data['discount'] ?? 0);

            $this->validateDiscount(
                $discount,
                $subtotal
            );

            $total = $subtotal - $discount;

            $amountPaid = (float) ($data['amount_paid'] ?? 0);

            $paymentMethod = $data['payment_method'] ?? null;

            $this->validatePayment(
                $amountPaid,
                $total,
                $paymentMethod
            );

            $paymentStatus = $this->determinePaymentStatus(
                $amountPaid,
                $total
            );

            $sale = $shop->sales()->create([
                'user_id' => $user->id,
                'customer_id' => $customer?->id,
                'reference' => $this->generateReference(),
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'amount_paid' => $amountPaid,
                'payment_method' => $paymentMethod,
                'status' => 'completed',
                'payment_status' => $paymentStatus,
                'sold_at' => now(),
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($items as $item) {
                $sale->items()->create([
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total'],
                ]);
            }

            $this->removeStock(
                $shop,
                $user,
                $sale,
                $items
            );

            return $sale->load([
                'customer',
                'user',
                'items.product',
            ]);
        });
    }

    public function cancel(
        Shop $shop,
        User $user,
        Sale $sale
    ): Sale {
        return DB::transaction(function () use (
            $shop,
            $user,
            $sale
        ) {
            abort_unless(
                $sale->shop_id === $shop->id,
                404
            );

            if ($sale->status === 'cancelled') {
                throw new SaleAlreadyCancelledException();
            }

            $sale->load('items.product');

            foreach ($sale->items as $item) {
                $this->stockMovementService->create(
                    $shop,
                    $user,
                    [
                        'product_id' => $item->product_id,
                        'type' => 'entry',
                        'quantity' => $item->quantity,
                        'reason' => 'Annulation de vente',
                        'reference' => $sale->reference,
                        'notes' => "Restauration du stock suite à l'annulation de la vente {$sale->reference}.",
                    ]
                );
            }

            $sale->update([
                'status' => 'cancelled',
            ]);

            return $sale->refresh();
        });
    }

    private function getCustomer(
        Shop $shop,
        ?int $customerId
    ): ?Customer {
        if ($customerId === null) {
            return null;
        }

        $customer = $shop->customers()
            ->whereKey($customerId)
            ->first();

        abort_unless($customer, 404);

        return $customer;
    }

    private function prepareItems(
        Shop $shop,
        array $items
    ): array {
        if (empty($items)) {
            throw new RuntimeException(
                'Une vente doit contenir au moins un produit.'
            );
        }

        $preparedItems = [];

        foreach ($items as $item) {
            $product = $shop->products()
                ->whereKey($item['product_id'])
                ->where('is_active', true)
                ->first();

            abort_unless($product, 404);

            $quantity = (int) $item['quantity'];

            if ($quantity <= 0) {
                throw new RuntimeException(
                    "La quantité du produit « {$product->name} » doit être supérieure à zéro."
                );
            }

            $unitPrice = (float) $product->selling_price;

            $preparedItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total' => $unitPrice * $quantity,
            ];
        }

        return $preparedItems;
    }

    private function calculateSubtotal(array $items): float
    {
        return array_sum(
            array_column($items, 'total')
        );
    }

    private function validateDiscount(
        float $discount,
        float $subtotal
    ): void {
        if ($discount < 0) {
            throw new InvalidDiscountException(
                'La remise ne peut pas être négative.'
            );
        }

        if ($discount > $subtotal) {
            throw new InvalidDiscountException(
                'La remise ne peut pas être supérieure au sous-total.'
            );
        }
    }

    private function removeStock(
        Shop $shop,
        User $user,
        Sale $sale,
        array $items
    ): void {
        foreach ($items as $item) {
            $this->stockMovementService->create(
                $shop,
                $user,
                [
                    'product_id' => $item['product']->id,
                    'type' => 'exit',
                    'quantity' => $item['quantity'],
                    'reason' => 'Vente',
                    'reference' => $sale->reference,
                    'notes' => "Sortie de stock liée à la vente {$sale->reference}.",
                ]
            );
        }
    }

    private function generateReference(): string
    {
        do {
            $reference = 'VTE-'
                . now()->format('Ymd')
                . '-'
                . Str::upper(Str::random(6));
        } while (
            Sale::where('reference', $reference)->exists()
        );

        return $reference;
    }

    private function validatePayment(
        float $amountPaid,
        float $total,
        ?string $paymentMethod
    ): void {
        if ($amountPaid < 0) {
            throw new InvalidPaymentException(
                'Le montant payé ne peut pas être négatif.'
            );
        }

        if ($amountPaid > $total) {
            throw new InvalidPaymentException(
                'Le montant payé ne peut pas être supérieur au total de la vente.'
            );
        }

        if ($amountPaid > 0 && empty($paymentMethod)) {
            throw new InvalidPaymentException(
                'Veuillez sélectionner un mode de paiement.'
            );
        }
    }

    private function determinePaymentStatus(
        float $amountPaid,
        float $total
    ): string {
        if ($amountPaid <= 0) {
            return 'unpaid';
        }

        if ($amountPaid < $total) {
            return 'partial';
        }

        return 'paid';
    }
}