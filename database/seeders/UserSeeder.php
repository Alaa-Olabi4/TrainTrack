<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name'=>'Admin',
            'email'=>'admin@mail.com',
            'password'=> Hash::make('adminadmin'),
            'position' => 'Manager',
            'section_id' => 1,
            'role_id' => 1,
        ]);

        User::create([
            'name'=>'Alaa',
            'email'=>'alolaby25@gmail.com',
            'password'=> Hash::make('12345678'),
            'role_id'=>3,
            'section_id'=>1,
            'position' => 'Coordinator',
        ]);

        User::create([
            'name'=>'trainer',
            'email'=>'trainer@mail.com',
            'password'=> Hash::make('12345678'),
            'role_id'=>3,
            'section_id'=>1,
            'position' => 'Coordinator',
        ]);

        User::factory()
        ->count(10)
        ->create([
            'role_id'=>3,
            'section_id'=>1,
            'position' => 'Coordinator',
            'password'=>Hash::make('12345678'),
        ]);

        User::factory()
        ->count(10)
        ->create([
            'role_id'=>5,
            'section_id'=>1,
            'position' => 'Rep',
            'password'=>Hash::make('12345678'),
        ]);

        // User::create([
        //     'name', 
        //     'email',
        //     'role_id',
        //     'section_id',
        //     'position',
        //     'code',
        //     'img_url',
        //     'password'
        // ]);
    }
}
