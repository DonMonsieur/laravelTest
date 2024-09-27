<?php

use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/posts', [UserController::class, 'index']);
Route::get('/categories/posts', [CategoryPostController::class, 'categoriesWithPosts']);
Route::get('/posts/categories', [CategoryPostController::class, 'postsWithCategories']);
Route::get('/test', [CategoryPostController::class, 'test']);
Route::get('/fetchingDataWithPivotTable', [CategoryPostController::class, 'fetchingDataWithPivotTable']);

// Route::post('/categories/{categoryId}/attach-post', [CategoryPostController::class, 'attachPost']);
// Route::post('/categories/{categoryId}/detach-post', [CategoryPostController::class, 'detachPost']);
// Route::post('/categories/{categoryId}/sync-posts', [CategoryPostController::class, 'syncPosts']);
// Route::get('/category-posts/{id}', [CategoryPostController::class, 'getAllCategoryPostsWithTitles']);

Route::prefix('category-posts')->group(function () {
    Route::get('/', [CategoryPostController::class, 'getAllCategoryPostsWithTitles']);
    Route::get('/{id}', [CategoryPostController::class, 'show']);
    Route::post('/', [CategoryPostController::class, 'store']);
    Route::put('/{id}', [CategoryPostController::class, 'update']);
    Route::delete('/{id}', [CategoryPostController::class, 'destroy']);
});