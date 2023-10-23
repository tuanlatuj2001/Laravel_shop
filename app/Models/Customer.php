<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';
    protected $fillable = ['fullname', 'email', 'phone_number', 'address'];

    public function order_items()
    {
        return $this->hasMany(Order_item::class, 'customer_id', 'customer_id');
    }
}