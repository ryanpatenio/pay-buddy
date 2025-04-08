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
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'johnDoe@example.com',
                'password' => Hash::make('password'),
                'role' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Loop through users and insert them into the 'users' table
        foreach ($users as $user) {
            // Insert user and get the inserted user's ID
            $userId = DB::table('users')->insertGetId($user);
       
            // Now insert user details related to the userId
            DB::table('user_details')->insert([
                'user_id' => $userId
            ]);
        }
        
    
    }
}
