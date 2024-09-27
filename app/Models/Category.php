<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_posts')
            ->withPivot('subcategory_id')
            ->withTimestamps();
    }

    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'category_posts')
            ->withPivot('post_id')
            ->withTimestamps();
    }

    public static function categoriesWithDistinctPosts()
    {
        return self::with(['posts' => function ($query) {
            $query->select('posts.id', 'category_id')->distinct();
        }])->get();
    }
}
