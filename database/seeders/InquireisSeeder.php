<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;

class InquireisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Inquiry::factory()
            ->count(50)
            ->create()
            ->each(function ($inquiry) {
                $inquiry->followUps()->create([
                    'status' => rand(1, 4),
                    'follower_id' => rand(1, 4),
                    'section_id' => rand(1, 8),
                    'response' => 'Initial review in progress'
                ]);

                $inquiry->ratings()->create([
                    'user_id' => rand(1, 5),
                    'score' => rand(1, 5),
                    'feedback_text' => 'Auto-generated feedback'
                ]);
            });

        // Inquiry::create([
        //     'user_id' => 23,
        //     'assignee_id' => 2,
        //     'category_id' => 1,
        //     'cur_status_id' => 1,
        //     'title' => "استفسار عن خدمة سوبركليب",
        //     'body' => "كيف يمكن تفعيل السوبر كليب",
        //     // 'response',
        //     // 'closed_at'
        // ]);
        // Inquiry::create([
        //     'user_id' => 23,
        //     'assignee_id' => 2,
        //     'category_id' => 1,
        //     'cur_status_id' => 2,
        //     'title' => "استفسار عن خدمة سوبركليب",
        //     'body' => "كيف يمكن تفعيل السوبر كليب",
        //     // 'response',
        //     // 'closed_at'
        // ]);
        // Inquiry::create([
        //     'user_id' => 23,
        //     'assignee_id' => 2,
        //     'category_id' => 2,
        //     'cur_status_id' => 3,
        //     'title' => "استفسار عن خدمة سوبركليب",
        //     'body' => "كيف يمكن تفعيل السوبر كليب",
        //     'response' => " من خلال *111#",
        //     // 'closed_at' null,
        // ]);
        // Inquiry::create([
        //     'user_id' => 23,
        //     'assignee_id' => 2,
        //     'category_id' => 3,
        //     'cur_status_id' => 4,
        //     'title' => "استفسار عن خدمة سوبركليب",
        //     'body' => "كيف يمكن تفعيل السوبر كليب",
        //     // 'response',
        //     // 'closed_at'
        // ]);
    }
}
