<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFonctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonctions', function (Blueprint $table) {
            $table->id();
            $table->string("sigle");
            $table->string("libelle");
            $table->string("slug")->nullable();
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
        Schema::table("fonctions", function(Blueprint $table){
            $table->dropForeign("service_id");
        });
        Schema::dropIfExists('fonctions');
    }
}
