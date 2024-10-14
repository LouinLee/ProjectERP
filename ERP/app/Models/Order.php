<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_code', 'cart_code', 'customer_code', 'total_price', 'status', 'date'];

    protected $primaryKey = 'order_code';
    public $incrementing = false; // Disable incrementing as the key is not an auto-incrementing integer
    protected $keyType = 'string';

    // Define the relationship with the Cart model
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_code', 'cart_code');
    }

    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_code', 'customer_code');
    }

    // Define the relationship with OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_code', 'order_code');
    }
}
