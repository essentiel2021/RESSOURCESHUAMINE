<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSigleColoumToSuccursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('succursales', function (Blueprint $table) {
            $table->dropColumn('sigle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('succursales', function (Blueprint $table) {
            $table->string('sigle')->after('id');
        });
    }
}
