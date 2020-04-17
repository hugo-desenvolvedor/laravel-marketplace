<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile_phone',
        'slug',
        'logo',
    ];

    /**
     * Generate slug name when the Store is created.
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get user.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get products.
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get orders.
     *
     * @return BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(UserOrder::class);
    }
}
