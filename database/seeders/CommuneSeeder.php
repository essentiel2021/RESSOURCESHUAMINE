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
            ["libelle"=> "Treichville"],
            ["libelle"=> "PortBouet"],
            ["libelle"=> "Yopougon"],
            ["libelle"=> "Adjamé"],
            ["libelle"=> "Cocody"],
            ["libelle"=> "Bingerville"],
            ["libelle"=> "Plateau"],
        );
    }
}
