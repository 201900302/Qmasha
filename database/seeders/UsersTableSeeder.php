<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        
        DB::table('users')->insert([

        [
            //Vendor
            'name' => 'vendor',
            'boutiqueName' => 'vendor',
            'email' => 'vendor@gmail.com' ,
            'password' => Hash::make('vendor123'),
            'phone' => '38399385',
            'role' => 'vendor',
            'status' => 'active',


        ]
    
    
    ]);



    DB::table('users')->insert([

        [

        //Admin
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('Admin123'),
        'phone' => '38399384',
        'role' => 'admin',
        'status' => 'active',

        ],

    [
        //User
        'name' => 'user',
        'email' => 'user@gmail.com',
        'password' => Hash::make('user123'),
        'phone' => '38399386',
        'role' => 'user',
        'status' => 'active',


    ],


]);

        //Vendor

        //Users
    }
}
