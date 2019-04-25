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
        		'role' => 'administrador',
                'birthdate' => '1991-01-09',
                'address' => 'Santiago Calle 13 con Avenida 12'
        	],
            [
                'name' => 'Alberto Vargas',
                'email' => 'avargas@frontuari.net',
                'password' => bcrypt('Alber2244to*'),
                'role' => 'profesor',
                'birthdate' => '1993-08-09',
                'address' => 'Santiago Calle 13 con Avenida 12'
            ],
            [
                'name' => 'Daniel Vargas',
                'email' => 'dvargas@frontuari.net',
                'password' => bcrypt('Dani2244el*'),
                'role' => 'estudiante',
                'birthdate' => '2000-01-01',
                'address' => 'Santiago Calle 13 con Avenida 12'
            ]
        ]);
    }
}
