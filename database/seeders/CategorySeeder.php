<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->delete();

        $categories = [
            [
                'category' => 'Life',
                'title' => 'Stay Calm And Surf',
                'cover' => 'category/ca1.png',
            ],
            [
                'category' => 'Fashion',
                'title' => 'Becoming a Dragonfly',
                'cover' => 'category/ca2.png',
            ],
            [
                'category' => 'Travel',
                'title' => "There's always light at the end of the tunnel",
                'cover' => 'category/ca3.png',
            ],
            [
                'category' => 'Sport',
                'title' => 'Becoming a Dragonfly',
                'cover' => 'category/ca4.png',
            ],
            [
                'category' => 'Fun',
                'title' => "There's always light at the end of the tunnel",
                'cover' => 'category/ca5.png',
            ],
            [
                'category' => 'Health',
                'title' => "Becoming a Dragonfly",
                'cover' => 'category/ca6.png',
            ],
            [
                'category' => "Business",
                'title' => "Stay Calm And Surf",
                'cover' => 'category/ca6.png',
            ],
            [
                'category' => "Technology",
                'title' => "There's always light at the end of the tunnel",
                'cover' => 'category/ca6.png',
            ]
        ];
        foreach ($categories as $category) {
            Category::create([
                'category' => $category['category'],
                'title' => $category['title'],
                'cover' => $category['cover'],
                ]);
        }
    }
}
