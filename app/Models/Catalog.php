<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $fillable = ['catalog_name', 'parent_id', 'status', 'cat_slug'];
    protected $primaryKey = 'catalog_id';

    function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    function catagoryChildrent()
    {
        return $this->hasMany(Catalog::class, 'parent_id');
    }
}