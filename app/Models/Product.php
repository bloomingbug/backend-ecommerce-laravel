<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'category_id',
        'user_id',
        'description',
        'weight',
        'price',
        'stock',
        'discount',
    ];

    /**
     * Get the categories that owns the Product
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the reviews for the Product
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Image Accessor
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get:fn($value) => asset('/storage/products/' . $value),
        );
    }

    /**
     * Accessor Rating
     *
     * @return Attribute
     */
    protected function reviewAvgRating(): Attribute
    {
        return Attribute::make(
            get:fn($value) => $value ? substr($value, 0, 3) : 0,
        );
    }

}
