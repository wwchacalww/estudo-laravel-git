<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = [
      'ensino','serie','turma','turno','ano','created_at','updated_at'
    ];

    public function alunos()
    {
      return $this->hasMany('App\Aluno');
    }
}
