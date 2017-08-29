<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('nota', 6, 2)->nullable();
            $table->integer('faltas')->nullable();
            $table->enum('bimestre',[1, 2, 3, 4 , 5]);
            $table->integer('aluno_id')->unsigned()->index()->foreign()->references("id")->on("alunos")->onDelete("cascade");
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
        Schema::dropIfExists('rendimentos');
    }
}
