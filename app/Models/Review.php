<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'customer_id',
        'rating',
        'review',
    ];

    /**
     * Get the product that owns the Review
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the customer that owns the Review
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
