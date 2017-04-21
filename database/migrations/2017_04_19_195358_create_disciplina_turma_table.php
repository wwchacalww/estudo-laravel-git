<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinaTurmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina_turma', function (Blueprint $table) {
          $table->integer('disciplina_id')->unsigned()->index()->foreign()->references("id")->on("disciplinas")->onDelete("cascade");
          $table->integer('turma_id')->unsigned()->index()->foreign()->references("id")->on("turmas")->onDelete("cascade");
          $table->primary(['disciplina_id','turma_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplina_turma');
    }
}
