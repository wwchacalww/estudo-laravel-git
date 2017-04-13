<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpregadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empregados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('matricula');
            $table->date('data_admissao');
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('endereco');
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->integer('ch');
            $table->string('funcao');
            $table->enum('turno',['Matutino','Vespertino','Noturno']);
            $table->enum('status',['Ativo','Inativo']);
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
        Schema::dropIfExists('empregados');
    }
}
