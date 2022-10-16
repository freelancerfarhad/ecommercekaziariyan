<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'=>'1',
            'name'=>'Admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin123'),
        ]);

        DB::table('users')->insert([
            'role_id'=>'2',
            'name'=>'Author',
            'username'=>'author',
            'email'=>'author@gmail.com',
            'password'=>bcrypt('author123'),
        ]);
    }
}
