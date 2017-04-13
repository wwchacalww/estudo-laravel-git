<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndisciplinaOcorrencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indisciplina_ocorrencia', function (Blueprint $table) {
          $table->integer('indisciplina_id')->unsigned();
          $table->foreign('indisciplina_id')->references('id')->on('indisciplinas');
          $table->integer('ocorrencia_id')->unsigned();
          $table->foreign('ocorrencia_id')->references('id')->on('ocorrencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indisciplina_ocorrencia');
    }
}
