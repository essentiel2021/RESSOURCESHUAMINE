<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permissions")->insert([
            ["libelle"=> "ajouter un employe"],
            ["libelle"=> "consulter un employe"],
            ["libelle"=> "editer un employe"],
            ["libelle"=> "rechercher un employe"],
            ["libelle"=> "supprimer un employe"]
        ]);
    }
}
