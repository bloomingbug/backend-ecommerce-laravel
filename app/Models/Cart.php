<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_id',
        'quantity',
        'price',
        'weight',
    ];

    /**
     * Get the product that owns the Cart
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the customer that owns the Cart
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
