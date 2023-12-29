<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['categories_title' => 'Fashion'],
            ['categories_title' => 'Beauty'],
            ['categories_title' => 'Travel'],
            ['categories_title' => 'Personal'],
            ['categories_title' => 'Lifestyle'],
            ['categories_title' => 'Health'],
            ['categories_title' => 'Fitness'],
            ['categories_title' => 'Education'],
            ['categories_title' => 'Marketing'],
            ['categories_title' => 'Finance']
        ];
        Categories::insert($data);
    }
}
