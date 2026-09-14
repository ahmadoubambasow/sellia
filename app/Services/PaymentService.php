<?php

namespace App\Services;

use App\Exceptions\InvalidPaymentException;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    /**
     * Enregistre un nouveau paiement sur une vente.
     */
    public function create(
        Shop $shop,
        User $user,
        Sale $sale,
        array $data
    ): Payment {
        return DB::transaction(function () use (
            $shop,
            $user,
            $sale,
            $data
        ) {
            $sale = Sale::query()
                ->where('id', $sale->id)
                ->where('shop_id', $shop->id)
                ->lockForUpdate()
                ->firstOrFail();

            $this->validateSale($sale);

            $amount = (float) $data['amount'];

            $amountPaid = (float) $sale->amount_paid;
            $remaining = max(
                0,
                (float) $sale->total - $amountPaid
            );

            $this->validateAmount($amount, $remaining);

            $payment = $sale->payments()->create([
                'user_id' => $user->id,
                'amount' => $amount,
                'payment_method' => $data['payment_method'],
                'paid_at' => $data['paid_at'] ?? now(),
                'notes' => $data['notes'] ?? null,
            ]);

            $newAmountPaid = $amountPaid + $amount;

            $sale->update([
                'amount_paid' => $newAmountPaid,
                'payment_status' => $this->determinePaymentStatus(
                    $newAmountPaid,
                    (float) $sale->total
                ),
            ]);

            return $payment->load('user');
        });
    }

    /**
     * Vérifie que la vente peut recevoir un paiement.
     */
    private function validateSale(Sale $sale): void
    {
        if ($sale->status !== 'completed') {
            throw new InvalidPaymentException(
                'Impossible d\'enregistrer un paiement sur une vente annulée.'
            );
        }

        if ((float) $sale->amount_paid >= (float) $sale->total) {
            throw new InvalidPaymentException(
                'Cette vente est déjà entièrement payée.'
            );
        }
    }

    /**
     * Vérifie le montant du paiement.
     */
    private function validateAmount(
        float $amount,
        float $remaining
    ): void {
        if ($amount <= 0) {
            throw new InvalidPaymentException(
                'Le montant du paiement doit être supérieur à zéro.'
            );
        }

        if ($amount > $remaining) {
            throw new InvalidPaymentException(
                'Le montant du paiement ne peut pas être supérieur au reste à payer.'
            );
        }
    }

    /**
     * Détermine le nouveau statut du paiement.
     */
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