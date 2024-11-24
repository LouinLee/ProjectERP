<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = ['cartdetail_code', 'cart_code', 'product_code', 'quantity', 'subtotal'];

    protected $primaryKey = 'cartdetail_code';
    public $incrementing = false; // Disable incrementing as the key is not an auto-incrementing integer
    protected $keyType = 'string';

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_code', 'cart_code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
}
