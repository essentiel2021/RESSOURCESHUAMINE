<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => "Achi",
            'lastName' => "Jathniel",
            'sexe' => "M",
            'email' =>'achijathniel@gmail.com',
            'password' => Hash::make('gracenebie@9419'),
        ]);
        DB::table('users')->insert([
            'name' => "Achi",
            'lastName' => "Grace",
            'sexe' => "F",
            'email' =>'grachi@gmail.com',

            'password' => Hash::make('gracenebie@9419'),
        ]);
        DB::table('users')->insert([
            'name' => "Kone",
            'lastName' => "Daniel",
            'sexe' => "M",
            'email' =>'daniel@gmail.com',
            'password' => Hash::make('gracenebie@9419'),
        ]);
    }
}
