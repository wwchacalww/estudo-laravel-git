<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCargaToDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
          $table->integer('carga_id')->unsigned()->nullable()->after('ano');
          $table->foreign('carga_id')->references('id')->on('cargas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            //
        });
    }
}
