<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogLatToEscenarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escenarios', function (Blueprint $table) {
            $table->Double('longitud');
            $table->Double('latitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escenarios', function (Blueprint $table) {
            $table->dropColumn('longitud');
            $table->dropColumn('latitud');
        });
    }
}
