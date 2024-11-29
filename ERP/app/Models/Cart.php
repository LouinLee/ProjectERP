<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['cart_code', 'customer_code', 'total_price', 'date'];

    protected $primaryKey = 'cart_code';
    public $incrementing = false; // Disable incrementing as the key is not an auto-incrementing integer
    protected $keyType = 'string';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_code', 'customer_code');
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'cart_code', 'cart_code');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'cart_code', 'cart_code');
    }
}
