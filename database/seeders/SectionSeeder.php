<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'name'=>'UAT & Training',
            'division'=> 'CC - Customer Care Support',
            'email' => 'UAT@mail.com'
        ]);
        Section::create([
            'name'=>'Segment Consumer',
            'division'=> 'Marketing - P&S',
            'email' => 'Segment@mail.com'
        ]);
        Section::create([
            'name'=>'CVM',
            'division'=> 'Marketing - P&S',
            'email' => 'CVM@mail.com'
        ]);
        Section::create([
            'name'=>'VAS - Adminstration&Operation',
            'division'=> 'IT - CSD',
            'email' => 'VAS@mail.com'
        ]);
        Section::create([
            'name'=>'Billing Adminstration',
            'division'=> 'IT - CSD',
            'email' => 'Billing@mail.com'
        ]);
        Section::create([
            'name'=>'IN Adminstration',
            'division'=> 'IT - CSD',
            'email' => 'IN@mail.com'
        ]);
        Section::create([
            'name'=>'Legal',
            'division'=> 'CEO',
            'email' => 'Legal@mail.com'
        ]);
        Section::create([
            'name'=>'Recruitment',
            'division'=> 'HR',
            'email' => 'Recruitment@mail.com'
        ]);
    }
}
