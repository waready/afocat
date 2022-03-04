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
            'email' => 'student@mail.com',
            'password' =>bcrypt('987654321'),

        ])->assignRole('Administrador');
    }
}
