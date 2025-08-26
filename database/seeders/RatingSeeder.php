<?php

namespace Database\Seeders;

use App\Models\Rating;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'inquiry_id' => 2,
            'user_id' => 14,
            'score' => 5,
            'feedback_text'=> 'v.good response'
        ]);
        Rating::create([
            'inquiry_id' => 2,
            'user_id' => 15,
            'score' => 1,
            'feedback_text'=> 'very poor response'
        ]);
        Rating::create([
            'inquiry_id' => 2,
            'user_id' => 16,
            'score' => 3,
            'feedback_text'=> 'unclear response , but we received the required'
        ]);
        Rating::create([
            'inquiry_id' => 2,
            'user_id' => 17,
            'score' => 4,
            'feedback_text'=> 'good response'
        ]);
    }
}
