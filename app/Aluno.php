<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
      'matricula', 'nome', 'dn', 'pai', 'mae','cep','endereco','telefone','turma_id','created_at','updated_at'
    ];

    public function turma()
    {
      return $this->belongsTo('App\Turma');
    }

    public function ocorrencias()
    {
        return $this->belongsToMany('App\Ocorrencia');
    }

    public function rendimentos()
    {
      return $this->hasMany('App\Rendimento');
    }
}
