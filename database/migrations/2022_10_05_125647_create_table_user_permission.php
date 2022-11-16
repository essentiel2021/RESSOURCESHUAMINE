<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("permission_id")->constrained();
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
        Schema::table('user_permission', function (Blueprint $table) {
            $table->dropForeign("user_permission_user_id_foreign");
            $table->dropForeign("user_permission_permission_id_foreign");

            $table->dropColumn("user_id");
            $table->dropColumn("permission_id");
        });
        Schema::dropIfExists('user_permission');
    }
}
