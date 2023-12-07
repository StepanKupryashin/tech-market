<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [];

        for($i = 0; $i < 30 ; $i++)
        {
            $products[] = [
                'name' => 'Товар ' . $i,
                'description' => 'описание к товару '. $i,
                'price' => random_int(0, 99999),
                'quantity' => random_int(0, 5)
            ];
        }

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
