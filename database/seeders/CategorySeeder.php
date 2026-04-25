<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Food',
            'Transport',
            'Shopping',
            'Entertainment',
            'Bills',
            'Health',
            'Education',
            'Others'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                [
                    'name' => $categoryName,
                    'user_id' => null
                ]
            );
        }
    }
}
