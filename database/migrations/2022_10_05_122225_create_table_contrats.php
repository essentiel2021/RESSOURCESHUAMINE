<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableContrats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string("libelle",150);
            $table->text("description");
            $table->date("debContrat");
            $table->date("finContrat");
            $table->boolean("activecontrat")->default(1);
            $table->string("slug",150)->nullable();
            $table->foreignId("type_contrat_id")->constrained();
            $table->foreignId("employe_id")->constrained();
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
        Schema::table("contrats", function(Blueprint $table){
            $table->dropForeign("type_contrat_id");
            $table->dropForeign("employe_id");
        });

        Schema::dropIfExists('contrats');
    }
}
