<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name'=>'Emad Hanouna',
            'email'=>'e@gmail.com',
            'password'=>Hash::make('pass1'),
        ]);

        DB::table('users')->insert([
            'name'=>'Hamdi Hanouna',
            'email'=>'h@gmail.com',
            'password'=>Hash::make('pass2'),
        ]);

        DB::table('users')->insert([
            'name'=>'Mohammed Hanouna',
            'email'=>'m@gmail.com',
            'password'=>Hash::make('pass3'),
        ]);

        DB::table('users')->insert([
            'name'=>'Ahmed Hanouna',
            'email'=>'a@gmail.com',
            'password'=>Hash::make('pass4'),
        ]);
    }
}
