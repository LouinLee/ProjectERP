<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['orderdetail_code', 'order_code', 'product_code', 'quantity', 'subtotal'];

    protected $primaryKey = 'order_code';
    public $incrementing = false; // Disable incrementing as the key is not an auto-incrementing integer
    protected $keyType = 'string';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }
}
