<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("communes")->insert(
            ["libelle"=> "Marcory"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "Treichville"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "PortBouet"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "Yopougon"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "Adjamé"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "Cocody"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "Bingerville"],
            ["created_at" => now()]
        );
        DB::table("communes")->insert(
            ["libelle"=> "Plateau"],
            ["created_at" => now()]
        );
    }
}
