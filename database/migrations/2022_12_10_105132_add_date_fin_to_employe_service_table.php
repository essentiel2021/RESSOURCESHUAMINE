<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateFinToEmployeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employe_service', function (Blueprint $table) {
            $table->date("date_fin")->after("date_debut");
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
            $table->dropColumn("date_fin");
        });
    }
}
