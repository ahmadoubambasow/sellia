<?php 

namespace App\Actions;

use App\Models\Shop;
use App\Models\User;

class CreateShopAction
{
    public function execute(User $user, array $data): Shop
    {
        return $user->shop()->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'currency' => $data['currency'] ?? 'XOF',
        ]);
    }
}