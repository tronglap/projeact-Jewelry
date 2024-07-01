<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_categories';
    protected $guarded = [];

    public function Blog()
    {
        return $this->hasMany(Blog::class, 'blog_category_id')->withTrashed();
    }
}
