<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'admin01',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole('admin');

        User::create([
            'name' => 'user01',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole('user');

        User::create([
            'name' => 'superAdmin01',
            'email' => 'sa@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole('superAdmin');

        User::create([
            'name' => 'superUser01',
            'email' => 'su@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole('superUser');
    }
}
