<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_title', 'post_excerpt', 'post_content', 'post_status', 'thumbnail_post', 'post_slug', 'user_id', 'catalog_posts_id'];
    protected $primaryKey = 'post_id';
    public function users()
    {
        return $this->belongsTo(user::class);
    }
    public function catalog_posts()
    {
        return $this->belongsTo(catalog_posts::class);
    }
}
