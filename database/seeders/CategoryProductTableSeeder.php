<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $products = Product::all();

        foreach ($categories as $category) {
            $category->products()->attach($products->random(rand(1, 5))->pluck('id')->toArray());
        }
    }
}
