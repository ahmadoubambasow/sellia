<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'description',
    ];

    /**
     * Boutique a laquelle appartient la categorie
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}
