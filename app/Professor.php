<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
  protected $fillable = [
      'professor', 'habilidade', 'sexo', 'empregado_id',
  ];

  public function empregado()
  {
    return $this->belongsTo('App\Empregado');
  }

  public function cargas()
  {
    return $this->hasMany('App\Carga');
  }
}
