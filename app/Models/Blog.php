<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $guarded = [];

    public function BlogCategories()
    {
        return $this->belongsTo(BlogCategories::class, 'blog_category_id')->withTrashed();
    }

    public static function recentPosts()
    {
        return self::orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();
    }
}
