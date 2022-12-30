<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("departements")->insert([
            'libelle' => 'Informatique',
            'succursale_id' =>3
        ]);

        DB::table("departements")->insert([
            'libelle' => 'Comptabilité',
            'succursale_id' =>3
        ]);

        DB::table("departements")->insert([
            'libelle' => 'Default',
            'succursale_id' =>3
        ]);
    }
}
