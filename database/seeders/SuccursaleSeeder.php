<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuccursaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("succursales")->insert([
            ['libelle' => 'Section 1'],
            ['libelle' => 'Section 2'],
            ['libelle' => 'Section 3']
        ]);
    }
}
