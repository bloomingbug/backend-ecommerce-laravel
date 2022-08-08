<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 'product_id', 'quantity', 'price',
    ];

    /**
     * Get all of the reviews for the Order
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the product that owns the Order
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
