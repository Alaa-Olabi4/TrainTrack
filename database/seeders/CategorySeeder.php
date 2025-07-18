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
            'description' => 'superclip'
        ]);
        Category::create([
            'name' => 'RBT',
            'description' => 'RBT'
        ]);
        Category::create([
            'name' => 'Prepaid & Postpaid Subscription ( Stay With us - Pick your number )',
            'description' => 'Prepaid & Postpaid Subscription ( Stay With us - Pick your number )'
        ]);
        Category::create([
            'name' => 'Post & Prepaid Cancelation',
            'description' => 'Post & Prepaid Cancelation'
        ]);
        Category::create([
            'name' => 'Line Reservation Post & Pre',
            'description' => 'Line Reservation Post & Pre'
        ]);
        Category::create([
            'name' => 'PUK Post & Pre',
            'description' => 'PUK Post & Pre'
        ]);
        Category::create([
            'name' => 'MTS via Dealers Pre via Dealers Pre',
            'description' => 'MTS via Dealers Pre'
        ]);
        Category::create([
            'name' => 'MTS via MTN Pre',
            'description' => 'MTS via MTN Pre'
        ]);
        Category::create([
            'name' => ' ATM Pre',
            'description' => ' ATM Pre'
        ]);
        Category::create([
            'name' => ' Annual Validity',
            'description' => ' Annual Validity'
        ]);
        Category::create([
            'name' => 'Waiting  Post & Pre',
            'description' => 'Waiting  Post & Pre'
        ]);
        Category::create([
            'name' => 'Conference  Post & Pre',
            'description' => 'Conference  Post & Pre'
        ]);
        Category::create([
            'name' => 'SMS  Post & Pre',
            'description' => 'SMS  Post & Pre'
        ]);
        Category::create([
            'name' => 'Divert  Post & Pre',
            'description' => 'Divert  Post & Pre'
        ]);
        Category::create([
            'name' => 'Clir',
            'description' => 'Clir'
        ]);
        Category::create([
            'name' => 'Call me',
            'description' => 'Call me'
        ]);
        Category::create([
            'name' => 'call screening',
            'description' => 'call screening'
        ]);
    }
}
