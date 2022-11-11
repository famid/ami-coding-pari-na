<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => "Test",
                'last_name' => "User1",
                'username' => "testuser1",
                'email' => "testuser1@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => USER_ROLE
            ],
            [
                'first_name' => "Test",
                'last_name' => "User2",
                'username' => "testuser2",
                'email' => "testuser2@gmail.com",
                'password' => Hash::make('12345678'),
                'role' => USER_ROLE
            ],

        ]);
    }
}
