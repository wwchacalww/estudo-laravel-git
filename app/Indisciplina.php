<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indisciplina extends Model
{
  protected $fillable = [
      'base', 'indisciplina'
  ];

  public function ocorrencias()
  {
      return $this->belongsToMany('App\Ocorrencia');
  }

}
