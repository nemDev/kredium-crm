<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('advisers')->insert([
            'name' => 'Joe Doe',
            'email' => 'joedoe@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => now()
        ]);

        DB::table('advisers')->insert([
            'name' => 'Tom Doe',
            'email' => 'tomdoe@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => now()
        ]);
    }
}
