<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function categoriesWithPosts()
    {
        $categories = Category::categoriesWithDistinctPosts();

        return response()->json(['data' => $categories]);
    }

    public function postsWithCategories()
    {
        $posts = Post::postsWithDistinctCategories();

        return response()->json(['data' => $posts]);
    }
}
