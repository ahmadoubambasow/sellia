<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        private readonly SearchService $searchService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $term = trim($request->input('q', ''));

        $results = $this->searchService->search(
            auth()->user()->shop,
            $term
        );

        return view('search.index', [
            'term' => $term,
            'results' => $results,
        ]);
    }

    public function suggestions(Request $request): JsonResponse
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $term = trim($request->input('q', ''));

        $results = $this->searchService->suggestions(
            auth()->user()->shop,
            $term
        );

        return response()->json([
            'products' => $results['products']->map(fn ($product) => [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'stock' => $product->stock_quantity,
                'url' => route('products.edit', $product),
            ])->values(),

            'customers' => $results['customers']->map(fn ($customer) => [
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'url' => route('customers.edit', $customer),
            ])->values(),

            'sales' => $results['sales']->map(fn ($sale) => [
                'id' => $sale->id,
                'reference' => $sale->reference,
                'customer' => $sale->customer?->name,
                'total' => $sale->total,
                'date' => $sale->sold_at->format('d/m/Y H:i'),
                'url' => route('sales.show', $sale),
            ])->values(),

            'categories' => $results['categories']->map(fn ($category) => [
                'id' => $category->id,
                'name' => $category->name,
                'url' => route('categories.edit', $category),
            ])->values(),
        ]);
    }
}