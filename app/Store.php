<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile_phone',
        'slug',
        'logo',
    ];

    /**
     * Get user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get products
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
