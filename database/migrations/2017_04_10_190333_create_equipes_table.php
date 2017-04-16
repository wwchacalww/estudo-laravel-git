<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('funcao',['Diretor','Vice-Diretor','Supervisor Administrativo','Supervisor Pedagógico','Coordenador Pedagógico','Assistente', 'Chefe de Secretaria']);
            $table->integer('empregado_id')->unsigned()->nullable();
            $table->foreign('empregado_id')->references('id')->on('empregados');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('equipes');
    }
}
