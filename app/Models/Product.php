<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'thumbnail', 'price', 'cat_id', 'product_datail', 'desc', 'status', 'stock_quantity', 'is_featured', 'slug'];
    protected $primaryKey = 'product_id';

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'product_id');
    }

    function catalogs()
    {
        return $this->belongsTo('App\Models\Catalog');
    }
}