<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
  protected $fillable = [
      'carga', 'ch', 'professor_id', 'turma_id',
  ];

  public function professor()
  {
    return $this->belongsTo('App\Professor');
  }

  public function turmas()
  {
      return $this->belongsToMany('App\Turma');
  }

  public function disciplinas()
  {
      return $this->hasMany('App\Disciplina');
  }

  public function turma()
  {
    return $this->belongsTo('App\Turma');
  }

  public function conselheiro()
  {
    return $this->belongsTo('App\Turma', 'turma_id');
  }

}
