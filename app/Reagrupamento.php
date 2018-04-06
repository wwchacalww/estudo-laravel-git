<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reagrupamento extends Model
{
  protected $fillable = [
      'aluno_id', 'disciplina_id', 'status', 'ano', 'requisito_id',
  ];

  public function aluno()
  {
    return $this->belongsTo('App\Aluno');
  }

  public function disciplina()
  {
    return $this->belongsTo('App\Disciplina');
  }

  public function requisito()
  {
    return $this->belongsTo('App\Requisito');
  }
}
