<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
  protected $fillable = [
    'dia', 'horario', 'turma_id', 'disciplina_id'
  ];

  public function turma()
  {
    return $this->belongsTo('App\Turma');
  }

  public function disciplina()
  {
    return $this->belongsTo('App\Disciplina');
  }
}
