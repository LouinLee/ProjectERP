<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_code', 'customer_name', 'email', 'address', 'phone_number', 'password'];

    protected $primaryKey = 'customer_code';
    public $incrementing = false; // Disable incrementing as the key is not an auto-incrementing integer
    protected $keyType = 'string';

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_code', 'customer_code');
    }
}
