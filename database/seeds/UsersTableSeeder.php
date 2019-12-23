<?php

use App\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'usuario@empresa.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => '',
            'dni'  => '111111111',
            'address' => 'xxxxxxx',
            'phone' => '000000000',
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Paciente',
            'email' => 'paciente@empresa.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => '',
            'dni'  => '111111111',
            'address' => 'xxxxxxx',
            'phone' => '000000000',
            'role' => 'patient',
        ]);
        User::create([
            'name' => 'Doctor',
            'email' => 'doctor@empresa.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => '',
            'dni'  => '111111111',
            'address' => 'xxxxxxx',
            'phone' => '000000000',
            'role' => 'doctor',
        ]);
        factory(User::class, 50)->states('patient')->create();
    }
}
