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
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'a@a.com',
            'password' => bcrypt('1'),
            'role_id' => 1
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'b@b.com',
            'password' => bcrypt('1'),
            'role_id' => 2
        ]);
    }
}
