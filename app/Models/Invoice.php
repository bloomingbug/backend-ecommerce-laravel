<?php

namespace App\Models;

use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice', 'customer_id', 'courier', 'courier_service', 'courier_cost', 'weight', 'name', 'phone', 'city_id', 'province_id', 'address', 'status', 'grand_total', 'snap_token',
    ];

    /**
     * Get all of the orders for the Invoice
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the customer that owns the Invoice
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the city that owns the Invoice
     *
     * @return void
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    /**
     * Get the province that owns the Invoice
     *
     * @return void
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
}
