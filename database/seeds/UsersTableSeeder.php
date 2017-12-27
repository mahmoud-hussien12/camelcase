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
            'name' => str_random(20),
            'email' => str_random(20).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
