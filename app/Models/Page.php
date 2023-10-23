<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['page_title', 'page_slug', 'page_content', 'page_status', 'user_id'];
    protected $primaryKey = 'page_id';
    public function users()
    {
        return $this->belongsTo(user::class);
    }
}