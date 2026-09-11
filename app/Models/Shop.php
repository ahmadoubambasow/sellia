<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'phone',
        'address',
        'currency',
        'logo',
    ];

    /**
     * Utilisateur propriétaire de la boutique
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Categories de la boutique
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
