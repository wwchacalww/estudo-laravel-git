<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passivo extends Model
{
  protected $fillable = [
      'passivo', 'matricula', 'nome_aluno',
  ];
}
