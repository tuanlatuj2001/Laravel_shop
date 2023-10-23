<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = ['product_quantity', 'total_amount', 'order_date', 'payment_method', 'shipping_address', 'note', 'order_code', 'product_id'];
}