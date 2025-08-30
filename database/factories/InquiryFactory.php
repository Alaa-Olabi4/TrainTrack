<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use App\Models\Status;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::where('role_id', 5)->inRandomOrder()->first()?->id;
        $assigneeId = User::where('role_id', 3)->inRandomOrder()->first()?->id;
        $categoryId = Category::inRandomOrder()->first()?->id;
        $statusId = Status::whereBetween('id', [1, 4])->inRandomOrder()->first()?->id;

        $createdAt = $this->faker->dateTimeBetween('-90 days', '-1 days');
        $isClosed = $statusId == 3;

        return [
            'user_id' => $userId,
            'assignee_id' => $assigneeId,
            'category_id' => $categoryId,
            'cur_status_id' => $statusId,
            'title' => $this->faker->randomElement([
                'SIM activation issue',
                'Billing discrepancy',
                'Network outage report',
                'Voicemail not working',
                'Data plan upgrade request',
                'International roaming problem',
                'Call drop complaint',
                'RBT subscription failed',
            ]),
            'body' => $this->faker->paragraphs(2, true),
            'response' => $isClosed ? $this->faker->sentence : null,
            'created_at' => $createdAt,
            'closed_at' => $isClosed
                ? (clone $createdAt)->modify('+' . rand(1, 80) . ' hours')
                : null,
        ];
    }
}
