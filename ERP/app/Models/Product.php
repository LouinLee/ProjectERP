<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_code', 'product_name', 'unit', 'price', 'quantity'];

    protected $primaryKey = 'product_code';
    public $incrementing = false; // Disable incrementing as the key is not an auto-incrementing integer
    protected $keyType = 'string';

    // Define the relationship with the OrderDetail model
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_code', 'product_code');
    }

    // Define the relationship with CartDetail model
    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'product_code', 'product_code');
    }
}
