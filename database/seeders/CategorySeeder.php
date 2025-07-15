<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'superclip',
            'description' => 'superclip'
        ]);
        Category::create([
            'name' => 'RBT',
            'description' => 'RBT'
        ]);
    }
}
