<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Time;

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
            'first_name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => Hash::make('password'),
            'updated_at'=>'2023-06-03 01:01:02',
            
        ]);
    }
}
