<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'product_name',
        'description',
        'price',
        'stok_quantity',
        'image1_url',
        'image2_url',
        'image3_url',
        'image4_url',
        'image5_url',
        'slug'
    ];

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    // Define the relationship with the ProductCategories model
    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }
}
