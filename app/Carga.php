<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
  protected $fillable = [
      'carga', 'ch',
  ];

  public function professor()
  {
    return $this->belongsTo('App\Professor');
  }
}
