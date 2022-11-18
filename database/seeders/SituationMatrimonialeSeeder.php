<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituationMatrimonialeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("situation_matrimoniales")->insert(
            ["libelle"=> "Célibataire"],
            ["created_at" => now()]
        );
        DB::table("situation_matrimoniales")->insert(
            ["libelle"=> "Divorsé(e)"],
            ["created_at" => now()]
        );
        DB::table("situation_matrimoniales")->insert(
            ["libelle"=> "Marié(e)"],
            ["created_at" => now()]
        );
        DB::table("situation_matrimoniales")->insert(
            ["libelle"=> "Veuf"],
            ["created_at" => now()]
        );
    }
}
