<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Électronique', 'slug' => 'electronique'],
            ['name' => 'Mode', 'slug' => 'mode'],
            ['name' => 'Maison', 'slug' => 'maison'],
            ['name' => 'Livres', 'slug' => 'livres'],
            ['name' => 'Informatique', 'slug' => 'informatique'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
