<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoOcorrencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_ocorrencia', function (Blueprint $table) {
          $table->integer('aluno_id')->unsigned();
          $table->foreign('aluno_id')->references('id')->on('alunos');
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
        Schema::dropIfExists('aluno_ocorrencia');
    }
}
