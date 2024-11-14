<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clothing = Category::create(['name' => 'Одежда']);
        $shoes = Category::create(['name' => 'Обувь']);
        $accessories = Category::create(['name' => 'Аксессуары']);

        Product::create([
            'name' => 'Кроссовки',
            'price' => 3000,
            'quantity' => 5,
            'category_id' => 2, // ID категории "Обувь"
        ]);

        Product::create([
            'name' => 'Футболка',
            'price' => 1200,
            'quantity' => 10,
            'category_id' => 1, // ID категории "Одежда"
        ]);

        Product::create([
            'name' => 'Сумка',
            'price' => 2000,
            'quantity' => 8,
            'category_id' => 3, // ID категории "Аксессуары"
        ]);
    }
}
