<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPaymentException;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Sale;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $paymentService
    ) {}

    /**
     * Affiche le formulaire d'ajout d'un paiement.
     */
    public function create(Sale $sale): View
    {
        $this->authorizeSale($sale);

        $sale->load([
            'customer',
            'payments.user',
        ]);

        return view('payments.create', compact('sale'));
    }

    /**
     * Enregistre le paiement.
     */
    public function store(
        StorePaymentRequest $request,
        Sale $sale
    ): RedirectResponse {
        $this->authorizeSale($sale);

        try {
            $this->paymentService->create(
                auth()->user()->shop,
                auth()->user(),
                $sale,
                $request->validated()
            );

            return redirect()
                ->route('sales.show', $sale)
                ->with(
                    'success',
                    'Paiement enregistré avec succès.'
                );

        } catch (InvalidPaymentException $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Vérifie que la vente appartient à la boutique connectée.
     */
    private function authorizeSale(Sale $sale): void
    {
        abort_unless(
            $sale->shop_id === auth()->user()->shop->id,
            404
        );
    }
}