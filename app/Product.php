<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'body',
        'price',
        'slug'
    ];

    /**
     * Get store
     *
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get categories that the products belongs
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(ProductPhotos::class);
    }
}
