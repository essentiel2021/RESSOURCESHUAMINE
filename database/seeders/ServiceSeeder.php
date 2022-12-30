<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("services")->insert([
            'libelle' => 'Transfert',
            'departement_id' =>1
        ]);

        DB::table("services")->insert([
            'libelle' => 'Maintenance',
            'departement_id' =>1
        ]);

        DB::table("services")->insert([
            'libelle' => 'Developpement',
            'departement_id' =>1
        ]);
    }
}
