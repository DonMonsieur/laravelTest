<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function test()
    {

        $category = Category::find(1);


        $posts = $category->posts;

        foreach ($posts as $post) {
            echo $post->title;
        }


        // $post = Post::find(1);


        // $categories = $post->categories;

        // foreach ($categories as $category) {
        //     echo $category->name;
        // }


        // // Fetch a category
        // $category = Category::find(1);

        // // Fetch only active posts for this category
        // $posts = $category->posts()->where('status', 'active')->get();

        // foreach ($posts as $post) {
        //     echo $post->title;
        // }

        // $category = Category::find(1);
        // $category->posts()->attach($postId); // Attach post with ID = $postId to this category

        // $category = Category::find(1);
        // $category->posts()->detach($postId); // Detach post with ID = $postId from this category

        // $category = Category::find(1);
        // $category->posts()->sync([1, 2, 3]);

        // $category = Category::find(1);
        // $posts = $category->posts()->paginate(10);

        // foreach ($posts as $post) {
        //     echo $post->title;
        // }

        // // Display pagination links
        // echo $posts->links();
    }

    public function getAllCategoryPostsWithTitles()
    {
        // Fetch all entries with related titles using Eloquent
        $categoryPosts = CategoryPost::with(['category', 'post', 'subcategory'])->get();

        // Map the results to include the desired titles
        $result = $categoryPosts->map(function ($categoryPost) {
            return [
                'id' => $categoryPost->id,
                'category_name' => $categoryPost->category->title,
                'post_title' => $categoryPost->post->title,
                'subcategory_name' => $categoryPost->subcategory->title,
                'created_at' => $categoryPost->created_at,
                'updated_at' => $categoryPost->updated_at,
            ];
        });

        // return response()->json(['data' => $categoryPosts]);
        return response()->json(['data' => $result]);
    }



    public function fetchingDataWithPivotTable()
    {

        $category = Category::find(1);


        $posts = $category->posts;

        foreach ($posts as $post) {
            echo $post->title;
            echo $post->pivot->created_at;
        }
    }

    public function attachPost(Request $request, $categoryId)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id'
        ]);

        $category = Category::findOrFail($categoryId);

        $category->posts()->attach($request->post_id);

        return response()->json(['message' => 'Post attached successfully']);
    }

    public function detachPost(Request $request, $categoryId)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id'
        ]);

        $category = Category::findOrFail($categoryId);

        $category->posts()->detach($request->post_id);

        return response()->json(['message' => 'Post detached successfully']);
    }

    public function syncPosts(Request $request, $categoryId)
    {
        $request->validate([
            'post_ids' => 'required|array',
            'post_ids.*' => 'exists:posts,id'
        ]);

        $category = Category::findOrFail($categoryId);

        $category->posts()->sync($request->post_ids);

        return response()->json(['message' => 'Posts synced successfully']);
    }

    // CRUD

    // Create a new CategoryPost
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'post_id' => 'required|exists:posts,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $categoryPost = CategoryPost::create($request->only(['category_id', 'post_id', 'subcategory_id']));

        return response()->json(['message' => 'CategoryPost created successfully', 'data' => $categoryPost], 201);
    }

    // Get a specific CategoryPost by ID
    public function show($id)
    {
        $categoryPost = CategoryPost::with(['category', 'post', 'subcategory'])->findOrFail($id);

        return response()->json(['data' => $categoryPost]);
    }

    // Update a CategoryPost
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'post_id' => 'required|exists:posts,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $categoryPost = CategoryPost::findOrFail($id);
        $categoryPost->update($request->only(['category_id', 'post_id', 'subcategory_id']));

        return response()->json(['message' => 'CategoryPost updated successfully', 'data' => $categoryPost]);
    }

    // Delete a CategoryPost
    public function destroy($id)
    {
        $categoryPost = CategoryPost::findOrFail($id);
        $categoryPost->delete();

        return response()->json(['message' => 'CategoryPost deleted successfully']);
    }
}
