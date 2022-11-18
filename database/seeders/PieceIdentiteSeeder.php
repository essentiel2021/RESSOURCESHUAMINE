<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PieceIdentiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("piece_identites")->insert(
            ["libelle"=> "Passeport"],
            ["libelle"=> "CNI"],
            ["libelle"=> "Attestation"],
        );
    }
}
