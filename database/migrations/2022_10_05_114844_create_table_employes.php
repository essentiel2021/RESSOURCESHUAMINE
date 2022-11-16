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
            $table->string("matricule")->unique()->nullable();
            $table->string("nom");
            $table->string("prenom");
            $table->date("dateNaissance");
            $table->char('sexe');
            $table->boolean("blackList")->default(0);
            $table->string("adresseMail",25)->nullable();
            $table->string("telephone1",25);
            $table->string("telephone2",25)->nullable();
            $table->string('pieceIdentite');
            $table->string('numeroPieceIdentite');
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
        Schema::dropIfExists('employes');
    }
}
