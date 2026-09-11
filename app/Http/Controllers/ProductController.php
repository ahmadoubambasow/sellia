<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    public function index(): View
    {
        $shop = auth()->user()->shop;

        $products = $this->productService->getByShop($shop);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = auth()->user()
            ->shop
            ->categories()
            ->orderBy('name')
            ->get();

        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->productService->create(
            $request->user()->shop,
            $request->validated()
        );

        return redirect()
            ->route('products.index')
            ->with('success', 'Le produit a été créé avec succès.');
    }

    public function edit(Product $product): View
    {
        $this->ensureBelongsToCurrentShop($product);

        $categories = auth()->user()
            ->shop
            ->categories()
            ->orderBy('name')
            ->get();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(
        UpdateProductRequest $request,
        Product $product
    ): RedirectResponse {
        $this->ensureBelongsToCurrentShop($product);

        $this->productService->update(
            $product,
            $request->validated()
        );

        return redirect()
            ->route('products.index')
            ->with('success', 'Le produit a été modifié avec succès.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->ensureBelongsToCurrentShop($product);

        $this->productService->delete($product);

        return redirect()
            ->route('products.index')
            ->with('success', 'Le produit a été supprimé avec succès.');
    }

    private function ensureBelongsToCurrentShop(Product $product): void
    {
        abort_unless(
            $product->shop_id === auth()->user()->shop->id,
            404
        );
    }
}