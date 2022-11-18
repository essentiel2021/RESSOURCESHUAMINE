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
            ["libelle"=> "Marié(e)"],
            ["libelle"=> "Divorsé(e)"],
            ["libelle"=> "Veuf"],
        );
    }
}
