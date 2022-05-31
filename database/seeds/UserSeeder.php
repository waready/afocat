<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'Student Primary',
           // 'apellidos'  => 'Secondary',
            //'dni'  => '987654321',
            'email' => 'admin@mail.com',
            'password' =>bcrypt('987654321'),

        ])->assignRole('Administrador');

        User::create([
            'name'  => 'Walter Admin',
           // 'apellidos'  => 'Secondary',
            //'dni'  => '987654321',
            'email' => 'walter@gmail.com',
            'password' =>bcrypt('987654321'),

        ])->assignRole('Administrador');
    }
}
