<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
          $table->increments('id');
          $table->enum('ensino',['Ensino Fundamental','Ensino Médio'])->default('Ensino Fundamental');
          $table->string('serie');
          $table->string('turma');
          $table->enum('turno', ['Matutino','Vespertino']);
          $table->integer('ano')->default(date('Y'));
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
        Schema::dropIfExists('turmas');
    }
}
