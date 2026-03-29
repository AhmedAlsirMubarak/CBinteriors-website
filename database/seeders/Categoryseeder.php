<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Living Room',  'slug' => 'living-room',  'sort_order' => 1],
            ['name' => 'Bedroom',      'slug' => 'bedroom',      'sort_order' => 2],
            ['name' => 'Dining Room',  'slug' => 'dining-room',  'sort_order' => 3],
            ['name' => 'Home Office',  'slug' => 'home-office',  'sort_order' => 4],
            ['name' => 'Outdoor',      'slug' => 'outdoor',      'sort_order' => 5],
            ['name' => 'Lighting',     'slug' => 'lighting',     'sort_order' => 6],
            ['name' => 'Accessories',  'slug' => 'accessories',  'sort_order' => 7],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(['slug' => $data['slug']], array_merge($data, ['active' => true]));
        }
    }
}