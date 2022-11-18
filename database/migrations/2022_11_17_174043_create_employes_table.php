<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
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
            $table->string("matricule")->unique()->nullable();
            $table->string("nom");
            $table->string("prenom");
            $table->foreignId('situation_matrimoniale_id')->constrained();
            $table->foreignId('commune_id')->constrained();
            $table->foreignId('piece_identite_id')->constrained();
            $table->date("dateNaissance");
            $table->char('sexe');
            $table->integer("nombre_enfant");
            $table->boolean("blackList")->default(0);
            $table->string("adresseMail",25)->nullable();
            $table->string("telephone1",25);
            $table->string("telephone2",25)->nullable();
            $table->string('numeroPermis')->nullable();
            $table->string('numeroIdentite');
            $table->string("quartier");
            $table->integer('numeroCNPS')->nullable();
            $table->integer('numeroDos')->nullable();
            $table->string('personContact');
            $table->string('personContactNum');
            $table->string("acteNaissance")->nullable();
            $table->string("photoPiece")->nullable();
            $table->string("photo")->nullable();
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
            $table->dropForeign("employes_situation_matrimoniale_id_foreign");
            $table->dropColumn('situation_matrimoniale_id');

            $table->dropForeign("employes_commune_id_foreign");
            $table->dropColumn('commune_id');

            $table->dropForeign("employes_piece_identite_id_foreign");
            $table->dropColumn('piece_identite_id');
        });
        Schema::dropIfExists('employes');
    }
}
