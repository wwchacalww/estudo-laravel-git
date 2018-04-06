<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use App\Disciplina;
use App\Requisito;
use App\Reagrupamento;

class ReagrupamentosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function turma(Request $request)
  {
      $data = $request->all();
      $turma = Turma::find($data['turma']);
      $disciplina = Disciplina::find($data['disciplina']);
      $requisito = Requisito::find($data['requisito']);
      foreach ($turma->alunos as $aluno) {
        $busca = Reagrupamento::where([
            ['aluno_id', '=', $aluno->id],
            ['disciplina_id', '=', $data['disciplina']],
            ['requisito_id', '=', $data['requisito']]
          ])->get();
        if (count($busca) == 0) {
          $novo = Reagrupamento::create(
            ['aluno_id' => $aluno->id,
            'disciplina_id' => $data['disciplina'],
            'status' => 'Inapto',
            'ano' => date('Y'),
            'requisito_id' => $data['requisito']]
          );
        }
      }
      return view('professors.turma',['turma'=>$turma, 'disciplina' => $disciplina, 'requisito' => $requisito]);
  }

  public function reagrupar(Reagrupamento $reagrupamento)
  {
      if($reagrupamento->status == 'Inapto'){
        $reagrupamento->status = 'Apto';
      }else{
        $reagrupamento->status = 'Inapto';
      }
      $reagrupamento->save();
      return back()->withInput();
  }
}
