<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService
    ) {
    }

    public function index(Request $request): View
    {
        $shop = $request->user()->shop;

        $search = $request->string('search')->trim()->toString();

        $customers = $this->customerService->getByShop(
            $shop,
            $search ?: null
        );

        return view(
            'customers.index',
            compact('customers', 'search')
        );
    }

    public function create(): View
    {
        return view('customers.create');
    }

    public function store(
        StoreCustomerRequest $request
    ): RedirectResponse {
        $this->customerService->create(
            $request->user()->shop,
            $request->validated()
        );

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Le client a été ajouté avec succès.'
            );
    }

    public function edit(Customer $customer): View
    {
        $this->ensureCustomerBelongsToCurrentShop($customer);

        return view('customers.edit', compact('customer'));
    }

    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ): RedirectResponse {
        $this->ensureCustomerBelongsToCurrentShop($customer);

        $this->customerService->update(
            $customer,
            $request->validated()
        );

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Les informations du client ont été mises à jour.'
            );
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $this->ensureCustomerBelongsToCurrentShop($customer);

        $this->customerService->delete($customer);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Le client a été supprimé avec succès.'
            );
    }

    private function ensureCustomerBelongsToCurrentShop(
        Customer $customer
    ): void {
        abort_unless(
            $customer->shop_id === auth()->user()->shop->id,
            404
        );
    }
}