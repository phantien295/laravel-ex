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
        	'username' => 'admin',
        	'password' => bcrypt('qwertyui'),
        	'level' => 1,
            // 'remember_token' => csrf_field(),
        ]);

        //  DB::table('users')->insert([
        // 	'username' => 'mem',
        // 	'email' => 'mem@gmail.com',
        // 	'password' => bcrypt('123456'),
        // 	'level' => 2
        // ]);
    }
}

