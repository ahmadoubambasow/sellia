<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    ) {}

    
    /**
     * Liste des catégories
     */
    public function index(): View
    {
        $shop = auth()->user()->shop;

        $categories = $this->categoryService->getByShop($shop);

        return view('categories.index', compact('categories'));
    }

    /**
     * Formulaire de création.
     */
    public function create(): View
    {
        return view ('categories.create');
    }

    /**
     * Enregistrer une catégorie
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->categoryService->create(
            $request->user()->shop,
            $request->validated()
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'La catégorie a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     
    * public function show(string $id)
    * {
      *   //
    * }
    */

    /**
     * Formulaire de modification.
     */
    public function edit(Category $category): View
    {
        $this->ensureBelongsToCurrentShop($category);

        return view('categories.edit', compact('category'));
    }

    /**
     * Mettre à jour une catégorie.
     */
    public function update(
        UpdateCategoryRequest $request,
        Category $category
    ): RedirectResponse {
        $this->ensureBelongsToCurrentShop($category);

        $this->categoryService->update(
            $category,
            $request->validated()
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'La catégorie a été modifiée avec succès.');
    }

    /**
     * Supprimer une catégorie.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->ensureBelongsToCurrentShop($category);

        $this->categoryService->delete($category);

        return redirect()
            ->route('categories.index')
            ->with('success', 'La catégorie a été supprimée avec succès.');
    }

     /**
     * Vérifier que la catégorie appartient à la boutique connectée.
     */
    private function ensureBelongsToCurrentShop(Category $category): void
    {
        abort_unless(
            $category->shop_id === auth()->user()->shop->id,
            404
        );
    }
}
