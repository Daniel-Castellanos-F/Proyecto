<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'Daniel Castellanos',
	        'email' => 'dani_samhain777@hotmail.com',
	        'password' => bcrypt('123456789'), // password
	        'cedula' => '1074186029',
	        'address' => '',
	        'role' => 'admin'
    	]);
        User::create([
            'name' => 'Fernando',
            'email' => 'instructor@example.net',
            'password' => bcrypt('123456789'), // password
            'cedula' => '1074186029',
            'role' => 'instructor'
        ]);
        User::create([
            'name' => 'Paola Silva',
            'email' => 'usuario@example.net',
            'password' => bcrypt('123456789'), // password
            'cedula' => '1074186029',
            'role' => 'usuario'
        ]);
        factory(User::class, 30)->create();
    }
}
