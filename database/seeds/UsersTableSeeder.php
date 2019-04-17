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
        	[
        		'name' => 'Carlos Vargas',
        		'email' => 'cvargas@frontuari.net',
        		'password' => bcrypt('Car2244los*'),
        		'role' => 'administrador'
        	],
            [
                'name' => 'Alberto Vargas',
                'email' => 'avargas@frontuari.net',
                'password' => bcrypt('Alber2244to*'),
                'role' => 'profesor'
            ],
            [
                'name' => 'Daniel Vargas',
                'email' => 'dvargas@frontuari.net',
                'password' => bcrypt('Dani2244el*'),
                'role' => 'estudiante'
            ]
        ]);
    }
}
