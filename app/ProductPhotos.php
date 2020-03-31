<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductPhotos
 * @package App
 */
class ProductPhotos extends Model
{
    protected $fillable = ['image'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
