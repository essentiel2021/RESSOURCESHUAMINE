<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreMoisColoumnToEmployeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employe_service', function (Blueprint $table) {
            $table->integer('nombre_mois')->nullable()->after('date_debut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employe_service', function (Blueprint $table) {
            $table->dropColumn('nombre_mois');
        });
    }
}
