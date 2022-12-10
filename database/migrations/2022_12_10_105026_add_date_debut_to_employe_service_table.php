<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateDebutToEmployeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employe_service', function (Blueprint $table) {
            $table->date("date_debut")->after("is_end");
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
            $table->dropColumn("date_debut");
        });
    }
}
