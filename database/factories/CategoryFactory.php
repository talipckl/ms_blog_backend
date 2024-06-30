<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->randomElement(['Life', 'Fashion', 'Travel', 'Sport', 'Fun', 'Health', 'Business', 'Technology']),
            'title' => $this->faker->sentence(),
            'cover' => $this->faker->randomElement(['category/ca1.png', 'category/ca2.png']),
        ];
    }
}
