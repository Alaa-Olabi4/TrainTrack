<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'superclip',
            'description' => 'superclip',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'RBT',
            'description' => 'RBT',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Prepaid & Postpaid Subscription ( Stay With us - Pick your number )',
            'description' => 'Prepaid & Postpaid Subscription ( Stay With us - Pick your number )',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Post & Prepaid Cancelation',
            'description' => 'Post & Prepaid Cancelation',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Line Reservation Post & Pre',
            'description' => 'Line Reservation Post & Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'PUK Post & Pre',
            'description' => 'PUK Post & Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'MTS via Dealers Pre via Dealers Pre',
            'description' => 'MTS via Dealers Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'MTS via MTN Pre',
            'description' => 'MTS via MTN Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => ' ATM Pre',
            'description' => ' ATM Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => ' Annual Validity',
            'description' => ' Annual Validity',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Waiting  Post & Pre',
            'description' => 'Waiting  Post & Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Conference  Post & Pre',
            'description' => 'Conference  Post & Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'SMS  Post & Pre',
            'description' => 'SMS  Post & Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Divert  Post & Pre',
            'description' => 'Divert  Post & Pre',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Clir',
            'description' => 'Clir',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'Call me',
            'description' => 'Call me',
            'owner_id' => 2
        ]);
        Category::create([
            'name' => 'call screening',
            'description' => 'call screening',
            'owner_id' => 2
        ]);
    }
}
