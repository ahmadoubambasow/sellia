<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Services\SaleService;
use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidDiscountException;
use App\Exceptions\InvalidPaymentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function __construct(
        private readonly SaleService $saleService
    ) {
    }

    /**
     * Liste des ventes de la boutique.
     */
    public function index(): View
    {
        $shop = auth()->user()->shop;

        $sales = $this->saleService->getByShop($shop);

        return view('sales.index', compact('sales'));
    }

    /**
     * Formulaire de création d'une vente.
     */
    public function create(): View
    {
        $shop = auth()->user()->shop;

        $products = $shop->products()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $customers = $shop->customers()
            ->orderBy('name')
            ->get();

        return view('sales.create', compact(
            'products',
            'customers'
        ));
    }

    /**
     * Enregistrer une nouvelle vente.
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        try {
            $sale = $this->saleService->create(
                $request->user()->shop,
                $request->user(),
                $request->validated()
            );
        } catch (InsufficientStockException $exception) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    "Stock insuffisant. Il reste "
                    . "{$exception->availableStock} unité(s), "
                    . "mais vous demandez "
                    . "{$exception->requestedQuantity} unité(s)."
                );
        } catch (
            InvalidDiscountException |
            InvalidPaymentException $exception
        ) {
            return back()
                ->withInput()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('sales.index')
            ->with(
                'success',
                "La vente {$sale->reference} a été enregistrée avec succès."
            );
    }
}