<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog_post extends Model
{
    use HasFactory;
    protected $fillable = ['catalog_post_name', 'parent_id', 'user_id', 'status'];
    protected $primaryKey = 'catalog_post_id';
    function post()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
