<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create(['category_id' => 1, 'owner_id' => 3, 'delegation_id' => 2]);
        Task::create(['category_id' => 2, 'owner_id' => 3, 'delegation_id' => 1]);
        Task::create(['category_id' => 3, 'owner_id' => 3, 'delegation_id' => 1]);
        Task::create(['category_id' => 4, 'owner_id' => 3, 'delegation_id' => 1]);
        Task::create(['category_id' => 5, 'owner_id' => 8, 'delegation_id' => 1]);
        Task::create(['category_id' => 6, 'owner_id' => 8, 'delegation_id' => 1]);
        Task::create(['category_id' => 7, 'owner_id' => 9, 'delegation_id' => 1]);
        Task::create(['category_id' => 8, 'owner_id' => 10, 'delegation_id' => 1]);
        Task::create(['category_id' => 9, 'owner_id' => 11, 'delegation_id' => 1]);
        Task::create(['category_id' => 10, 'owner_id' => 12, 'delegation_id' => 1]);
        Task::create(['category_id' => 11, 'owner_id' => 12, 'delegation_id' => 1]);
        Task::create(['category_id' => 12, 'owner_id' => 12, 'delegation_id' => 1]);
        Task::create(['category_id' => 13, 'owner_id' => 13, 'delegation_id' => 1]);
        Task::create(['category_id' => 14, 'owner_id' => 14, 'delegation_id' => 1]);
        Task::create(['category_id' => 15, 'owner_id' => 15, 'delegation_id' => 1]);
        Task::create(['category_id' => 16, 'owner_id' => 16, 'delegation_id' => 1]);
        Task::create(['category_id' => 17, 'owner_id' => 17, 'delegation_id' => 1]);
    }
}
