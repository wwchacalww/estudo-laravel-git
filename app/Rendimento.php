<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rendimento extends Model
{
  protected $fillable = [
      'nota', 'faltas', 'aluno_id', 'disciplina_id', 'bimestre'
  ];

  public function aluno()
  {
    return $this->belongsTo('App\Aluno');
  }

  public function disciplina()
  {
    return $this->belongsTo('App\Disciplina');
  }
}
