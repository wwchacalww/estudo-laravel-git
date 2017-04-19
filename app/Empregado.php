<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empregado extends Model
{
  protected $fillable = [
      'name', 'matricula', 'data_admissao', 'cpf', 'rg', 'endereco', 'telefone', 'email', 'ch', 'funcao', 'turno', 'status', 'user_id'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function equipe()
  {
    return $this->hasOne('App\Equipe');
  }

  public function professor()
  {
    return $this->hasOne('App\Professor');
  }
}
