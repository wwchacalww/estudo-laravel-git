<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
  protected $fillable = [
      'tipo', 'descricao', 'status', 'equipe_id', 'professor_id', 'created_at',
  ];

  public function alunos()
  {
      return $this->belongsToMany('App\Aluno');
  }

  public function indisciplinas()
  {
      return $this->belongsToMany('App\Indisciplina');
  }

  public function equipe()
  {
    return $this->belongsTo('App\Equipe');
  }

  public function professor()
  {
    return $this->belongsTo('App\Professor');
  }
}
