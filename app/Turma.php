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

    public function disciplinas()
    {
        return $this->belongsToMany('App\Disciplina');
    }

    public function cargas()
    {
        return $this->belongsToMany('App\Carga');
    }

}
