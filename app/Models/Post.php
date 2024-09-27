<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts')
            ->withPivot('subcategory_id')
            ->withTimestamps();
    }

    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'category_posts')
            ->withPivot('category_id')
            ->withTimestamps();
    }

    public static function postsWithDistinctCategories()
    {
        return self::with(['categories' => function ($query) {
            $query->select('category_id', 'post_id')->distinct();
        }])->get();
    }
}
