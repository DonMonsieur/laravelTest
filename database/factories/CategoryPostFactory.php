<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $post = Post::inRandomOrder()->first();
        $subcategory = SubCategory::inRandomOrder()->first();

        return [
            'category_id' => $category ? $category->id : null,
            'post_id' => $post ? $post->id : null,
            'subcategory_id' => $subcategory ? $subcategory->id : null,
        ];
    }
}
