<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favourite;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favourite::create([
            'inquiry_id'=>1,
            'user_id'=>3
        ]);
        Favourite::create([
            'inquiry_id'=>2,
            'user_id'=>3
        ]);
        Favourite::create([
            'inquiry_id'=>3,
            'user_id'=>3
        ]);
        Favourite::create([
            'inquiry_id'=>4,
            'user_id'=>3
        ]);
    }
}
