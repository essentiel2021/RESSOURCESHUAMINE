<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string("matricule")->unique();
            $table->string("nom");
            $table->string("prenom");
            $table->date("dateNaissance");
            $table->char('sexe');
            $table->string("adresseMail",25);
            $table->string("telephone1",25);
            $table->string("telephone2",25)->nullable();
            $table->integer('numeroCNPS')->nullable();
            $table->integer('numeroDos')->nullable();
            $table->string('personContact');
            $table->string('personContactNum');
            $table->string("quartier");
            $table->foreignId("fonction_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("employes", function(Blueprint $table){
            $table->dropForeign("fonction_id");
        });
        Schema::dropIfExists('employes');
    }
}
