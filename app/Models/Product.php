<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'short_description',
        'description',
        'specs',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'specs'     => 'array',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }
}