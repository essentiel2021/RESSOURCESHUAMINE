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
            ["created_at" => now()]
        );
        DB::table("piece_identites")->insert(
            ["libelle"=> "CNI"],
            ["created_at" => now()]
        );
        DB::table("piece_identites")->insert(
            ["libelle"=> "Attestation"],
            ["created_at" => now()]
        );
    }
}
