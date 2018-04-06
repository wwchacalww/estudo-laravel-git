<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
  protected $fillable = [
      'serie', 'habilidade', 'etapa', 'conteudo', 'pre_requisito'
  ];

  public function reagrupamentos()
  {
    return $this->hasMany('App\Reagrupamento');
  }
}
