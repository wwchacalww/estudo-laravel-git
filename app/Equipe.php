<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
  protected $fillable = [
      'funcao', 'user_id', 'empregado_id',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function empregado()
  {
    return $this->belongsTo('App\Empregado');
  }

  public function ocorrencias()
  {
    return $this->hasMany('App\Ocorrencia');
  }
}
