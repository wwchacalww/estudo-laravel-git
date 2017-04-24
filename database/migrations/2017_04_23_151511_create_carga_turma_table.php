<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargaTurmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_turma', function (Blueprint $table) {
          $table->integer('carga_id')->unsigned()->index()->foreign()->references("id")->on("cargas")->onDelete("cascade");
          $table->integer('turma_id')->unsigned()->index()->foreign()->references("id")->on("turmas")->onDelete("cascade");
          $table->primary(['carga_id','turma_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carga_turma');
    }
}
