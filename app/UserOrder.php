<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserOrder extends Model
{
    protected $fillable = [
        'reference',
        'pagseguro_code',
        'pagseguro_status',
        'items',
        'store_id'
    ];

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
     * Get store.
     *
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get stores.
     *
     * @return BelongsToMany
     */
    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }
}
