<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['name'=>'opened', 'value' => '-1']);
        Status::create(['name'=>'pending', 'value' => '0']);
        Status::create(['name'=>'closed', 'value' => '1']);
        Status::create(['name'=>'reopened', 'value' => '-5']);
    }
}
