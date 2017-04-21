<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
  protected $fillable = [
      'disciplina', 'habilidade', 'cor', 'professor_id', 'ano',
  ];
  public function professor()
  {
    return $this->belongsTo('App\Professor');
  }

  public function turmas()
  {
      return $this->belongsToMany('App\Turma');
  }
}
