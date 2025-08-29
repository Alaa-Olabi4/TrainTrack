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
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'assignee_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'cur_status_id' => Status::inRandomOrder()->first()->id,
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
            'response' => $this->faker->optional()->randomElement([
                'Your issue has been escalated to our technical team.',
                'We’ve refreshed your network settings remotely.',
                'Please restart your device and try again.',
                'We apologize for the inconvenience. A fix is underway.',
                'Your billing adjustment will reflect in the next cycle.',
                'Roaming services have been reactivated successfully.',
                'We’re currently experiencing a temporary outage in your area.',
                'closed_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            ]),
        ];
    }
}
