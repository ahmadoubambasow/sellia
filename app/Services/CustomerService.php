<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function getByShop(
        Shop $shop,
        ?string $search = null
    ): Collection {
        return $shop->customers()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();
    }

    public function create(
        Shop $shop,
        array $data
    ): Customer {
        return $shop->customers()->create([
            'name' => $data['name'],
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    public function update(
        Customer $customer,
        array $data
    ): Customer {
        $customer->update([
            'name' => $data['name'],
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        return $customer->refresh();
    }

    public function delete(Customer $customer): void
    {
        $customer->delete();
    }
}