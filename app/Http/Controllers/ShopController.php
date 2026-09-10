<?php

namespace App\Http\Controllers;

use App\Actions\CreateShopAction;
use App\Http\Requests\StoreShopRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (auth()->user()->shop) {
            return redirect()->route('dashboard');
        }

        return view('shop.setup');
    }

    public function store(StoreShopRequest $request, CreateShopAction $createShopAction): RedirectResponse {

        $user = $request->user();

        if ($user->shop) {
            return redirect()->route('dashboard');
        }

        $createShopAction->execute($user, $request->validated());

        return redirect()
            ->route('dashboard')
            ->with('success', 'Votre boutique a été créée avec succès.');
    }
}
