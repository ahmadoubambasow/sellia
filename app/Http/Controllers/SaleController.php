<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Sale;
use App\Services\SaleService;
use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidDiscountException;
use App\Exceptions\InvalidPaymentException;
use App\Exceptions\SaleAlreadyCancelledException;
use App\Services\SalesReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function __construct(
        private readonly SaleService $saleService,
        private readonly SalesReportService $salesReportService
    ) {
    }

    /**
     * Liste des ventes de la boutique.
     */
    public function index(): View
    {
        $shop = auth()->user()->shop;

        $sales = $this->saleService->getByShop($shop);

        $summary = $this->salesReportService->getSummary($shop);

        return view('sales.index', compact(
            'sales',
            'summary'
        ));
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

    public function show(Sale $sale): View
    {
        abort_unless(
            $sale->shop_id === auth()->user()->shop->id,
            404
        );

        $sale->load([
            'shop',
            'customer',
            'user',
            'items.product',
            'payments.user'
        ]);

        return view('sales.show', compact('sale'));
    }

    public function cancel(Sale $sale): RedirectResponse
    {
        try {
            $this->saleService->cancel(
                auth()->user()->shop,
                auth()->user(),
                $sale
            );
        } catch (SaleAlreadyCancelledException $exception) {
            return back()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('sales.show', $sale)
            ->with(
                'success',
                "La vente {$sale->reference} a été annulée et le stock a été restauré."
            );
    }

    public function receipt(Sale $sale): View
    {
        $sale->load([
            'shop',
            'customer',
            'user',
            'items.product',
            'payments.user',
        ]);

        abort_unless(
            $sale->shop_id === auth()->user()->shop->id,
            403
        );

        return view('sales.receipt', compact('sale'));
    }

    public function receiptPdf(Sale $sale)
    {
        abort_unless(
            $sale->shop_id === auth()->user()->shop->id,
            403
        );

        $sale->load([
            'shop',
            'customer',
            'user',
            'items.product',
            'payments.user',
        ]);

        $pdf = Pdf::loadView('sales.receipt-pdf', [
            'sale' => $sale,
        ]);

        $pdf->setPaper([0, 0, 226.77, 600], 'portrait');

        return $pdf->download(
            'ticket-' . $sale->reference . '.pdf'
        );
    }
}