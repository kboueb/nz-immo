<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@nz-immo.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],

            //Seller
            [
                'name' => 'Jacques Vendeur',
                'username' => 'vendeur1',
                'email' => 'jvendeur@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'status' => 'active',
            ],
            //User
            [
                'name' => 'User',
                'username' => 'user1',
                'email' => 'u1@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);

    }
}
