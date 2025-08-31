<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Notification::create([
                'inquiry_id' => rand(1, 20),
                'user_id' => 2,
                'message' => "You have received a new inquiry!",
            ]);
        }
    }
}
