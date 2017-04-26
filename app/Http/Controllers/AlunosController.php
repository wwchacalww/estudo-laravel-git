<?php

namespace App\Http\Controllers;
use App\Aluno;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    public function apiSelectAluno(Request $request)
    {
      $data = $request->all();
      if(isset($data['q'])){
        $consulta = $data['q'];
      }else{
        $consulta = 'asdjfkaçslkjfelkfjslkj';
      }
      $alunos = Aluno::where('nome','like', $consulta.'%')->with('turma')->get();
      $items['items'] = array();
      foreach ($alunos as $aluno) {
        $items['items'][]=['id'=>$aluno->id, 'text'=>$aluno->nome.' - '.$aluno->turma->turma];
      }
      return $items;
    }

    
}
