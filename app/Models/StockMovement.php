<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'product_id',
        'user_id',
        'type',
        'quantity',
        'reason',
        'reference',
        'notes',
        'stock_before',
        'stock_after',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'stock_before' => 'integer',
            'stock_after' => 'integer',
        ];
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isEntry(): bool
    {
        return $this->type === 'entry';
    }

    public function isExit(): bool
    {
        return $this->type === 'exit';
    }

    public function isAdjustment(): bool
    {
        return $this->type === 'adjustment';
    }
}