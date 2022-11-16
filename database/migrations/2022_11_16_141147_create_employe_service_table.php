<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId("employe_id")->constrained();
            $table->foreignId("service_id")->constrained();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employe_service', function (Blueprint $table) {
            $table->dropForeign("employe_service_employe_id_foreign");
            $table->dropForeign("employe_service_service_id_foreign");
            $table->dropColumn("employe_id");
            $table->dropColumn("service_id");
        });
        Schema::dropIfExists('employe_service');
    }
}
