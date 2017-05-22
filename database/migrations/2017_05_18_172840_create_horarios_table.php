<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('dia',['Segunda','Terça','Quarta','Quinta','Sexta']);
            $table->enum('horario',['1','2','3','4','5','6']);
            $table->integer('turma_id')->unsigned()->index()->foreign()->references("id")->on("turmas")->onDelete("cascade");
            $table->integer('disciplina_id')->unsigned()->index()->foreign()->references("id")->on("disciplinas")->onDelete("cascade");
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
        Schema::dropIfExists('horarios');
    }
}
