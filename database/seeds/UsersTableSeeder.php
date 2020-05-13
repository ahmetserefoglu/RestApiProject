<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'SuperAdmin',
            'email' => 'superadmin@panel.com',
            'email_verified_at' => now(),
            'phonenumber' => '05535345273',
            'verified' => 1,
            'rolename' => 'SuperAdmin',
            'token' => str_random(40),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@panel.com',
            'email_verified_at' => now(),
            'phonenumber' => '05535345271',
            'verified' => 1,
            'rolename' => 'Admin',
            'token' => str_random(40),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'User',
            'email' => 'user@panel.com',
            'email_verified_at' => now(),
            'phonenumber' => '05535345272',
            'verified' => 1,
            'rolename' => 'User',
            'token' => str_random(40),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
