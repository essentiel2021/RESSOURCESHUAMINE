<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEndToEmployeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employe_service', function (Blueprint $table) {
            $table->boolean("is_end")->default(0)->after("service_id");
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
            $table->dropColumn('is_end');
        });
    }
}
