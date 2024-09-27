<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';
    protected $fillable = ['name'];

    /**
     * The categories that belong to the subcategory.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts')
            ->withPivot('post_id') // Includes post_id in the pivot
            ->withTimestamps();
    }

    /**
     * The posts that belong to the subcategory.
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_posts')
            ->withPivot('category_id') // Includes category_id in the pivot
            ->withTimestamps();
    }
}
