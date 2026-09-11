<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientStockException;
use App\Http\Requests\StoreStockMovementRequest;
use App\Services\StockMovementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockMovementController extends Controller
{
    public function __construct(
        private readonly StockMovementService $stockMovementService
    ) {
    }

    public function index(): View
    {
        $shop = auth()->user()->shop;

        $movements = $this->stockMovementService
            ->getByShop($shop);

        return view('stock-movements.index', compact('movements'));
    }

    public function create(): View
    {
        $products = auth()->user()
            ->shop
            ->products()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('stock-movements.create', compact('products'));
    }

    public function store(
        StoreStockMovementRequest $request
    ): RedirectResponse {
        try {
            $this->stockMovementService->create(
                $request->user()->shop,
                $request->user(),
                $request->validated()
            );
        } catch (InsufficientStockException $exception) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    "Stock insuffisant. Il reste {$exception->availableStock} unité(s), "
                    . "mais vous demandez {$exception->requestedQuantity} unité(s)."
                );
        }

        return redirect()
            ->route('stock-movements.index')
            ->with(
                'success',
                'Le mouvement de stock a été enregistré avec succès.'
            );
    }
}