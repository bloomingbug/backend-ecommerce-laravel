<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password',
        'remember_token',
    ];

    /**
     * Get all of the invoices for the Customer
     *
     * @return void
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get all of the reviews for the Customer
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * createdAt Accessor
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get:fn($value) => Carbon::parse($value)->translatedFormat('l, d F Y'),

        );
    }

}
