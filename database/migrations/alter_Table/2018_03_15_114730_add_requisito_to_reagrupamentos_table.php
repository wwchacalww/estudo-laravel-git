<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequisitoToReagrupamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reagrupamentos', function (Blueprint $table) {
          $table->integer('requisito_id')->unsigned();
          $table->foreign('requisito_id')->references('id')->on('requisitos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reagrupamentos', function (Blueprint $table) {
            //
        });
    }
}
