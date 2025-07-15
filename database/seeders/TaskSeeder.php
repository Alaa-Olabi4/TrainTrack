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
        Task::create(['category_id'=>1,'owner_id'=>1,'delegation_id'=>2]);
        Task::create(['category_id'=>2,'owner_id'=>3,'delegation_id'=>1]);
    }
}
