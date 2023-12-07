<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriers = [
            [
                'name' => 'Холодильники',
            ],
            [
                'name' => 'Пылесосы'
            ],
            [
                'name' => 'Компьютеры'
            ]
        ];

        foreach($categoriers as $c) {
            Category::create($c);
        }
    }
}
