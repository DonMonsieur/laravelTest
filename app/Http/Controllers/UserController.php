<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->select('id', 'user_id', 'title')->get();

        return response()->json([
            'data' => $posts
        ]);
    }
}
