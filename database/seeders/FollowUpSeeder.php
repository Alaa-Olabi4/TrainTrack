<?php

namespace Database\Seeders;

use App\Models\FollowUp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FollowUp::create([
                    'inquiry_id'=>1,    
        'status'=>1,
        'follower_id'=>1,
        'section_id'=>1,
        ]);
        FollowUp::create([
                    'inquiry_id'=>1,
        'status'=>1,
        'follower_id'=>1,
        'section_id'=>1,
        ]);
        FollowUp::create([
                    'inquiry_id'=>1,
        'status'=>1,
        'follower_id'=>1,
        'section_id'=>2,
        ]);
        FollowUp::create([
                    'inquiry_id'=>1,
        'status'=>1,
        'follower_id'=>1,
        'section_id'=>2,
        ]);
    }
}
