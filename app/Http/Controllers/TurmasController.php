<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use Carbon;
class TurmasController extends Controller
{
    public function index()
    {
      $turmas = Turma::where('ano', date('Y'))->get();
      // $atrasados[$turma->id] = 0;
      foreach ($turmas as $turma ) {
        $atrasados[$turma->id] = 0;
        foreach ($turma->alunos as $aluno) {
          $age = Carbon::parse($aluno->dn)->age;
          if($turma->serie == '6º Ano' && $age > 12){
            $atrasados[$turma->id]++;
          }elseif($turma->serie == '7º Ano' && $age > 13){
            $atrasados[$turma->id]++;
          }elseif($turma->serie == '8º Ano' && $age > 14){
            $atrasados[$turma->id]++;
          }elseif($turma->serie == '9º Ano' && $age > 15){
            $atrasados[$turma->id]++;
          }
        }
      }
      return view('turmas.index', ['turmas'=>$turmas, 'atrasados' => $atrasados]);
    }

    public function show()
    {
      return view('turmas.show');
    }
    public function chart(){
      $turmas = Turma::where('ano', date('Y'))->get();
      $students['Total'] = 0;
      $students['Matutino']['total']= 0;
      $students['Vespertino']['total']=0;
      $students['Matutino']['atrasados']=0;
      $students['Vespertino']['atrasados']=0;
      $students['Atrasados'] = 0;
      $chart['turmas'] = array();
      $chart['total'] = array();
      $chart['atrasados'] = array();
      foreach($turmas as $turma){
        $tt = count($turma->alunos);
        $dis = 0;
        foreach($turma->alunos as $pupilo){
          $age = Carbon::parse($pupilo->dn)->age;
          if($turma->serie == '6º Ano' && $age > 12){
            $students['Atrasados']++;
            $dis++;
          }elseif($turma->serie == '7º Ano' && $age > 13){
            $students['Atrasados']++;
            $dis++;
          }elseif($turma->serie == '8º Ano' && $age > 14){
            $students['Atrasados']++;
            $dis++;
          }elseif($turma->serie == '9º Ano' && $age > 15){
            $students['Atrasados']++;
            $dis++;
          }
        }
        $students['Total'] += $tt;
        if($turma->turno == 'Matutino'){
          array_push($chart['turmas'], substr($turma->turma, 0, 5));
          array_push($chart['total'], $tt);
          array_push($chart['atrasados'], $dis);
          $students['Matutino']['total'] += $tt;
        }else{
          $students['Vespertino']['total'] += $tt;
        }
      }
      $chart['turmas'] = json_encode($chart['turmas']);
      $chart['total'] = json_encode($chart['total']);
      $chart['atrasados'] = json_encode($chart['atrasados']);

      return view('testes.chart',['turmas'=>$turmas, 'students'=>$students, 'chart' => $chart ]);
    }
    public function components(){
      return view('testes.components');
    }

    public function atrasadosPdf()
    {
      $turmas = Turma::where('ano',date('Y'))->get();
      $atrasados['6º Ano'] = 0;
      $atrasados['7º Ano'] = 0;
      $atrasados['8º Ano'] = 0;
      $atrasados['9º Ano'] = 0;
      $atrasados['Total'] = 0;
      foreach ($turmas as $turma) {
        if ($turma->serie == '6º Ano') {
          $idade = 12;
        }elseif($turma->serie == '7º Ano'){
          $idade = 13;
        }elseif($turma->serie == '8º Ano'){
          $idade = 14;
        }elseif($turma->serie == '9º Ano'){
          $idade = 15;
        }
        $atrasados[$turma->id]= 0;

        foreach ($turma->alunos as $aluno) {
          if (Carbon::Parse($aluno->dn)->age > $idade) {
            $atrasados[$turma->id]++;
            $atrasados[$turma->serie]++;
            $atrasados['Total']++;
          }
        }
      }
      return response()->view('turmas.atrasados',['turmas'=>$turmas, 'atrasados'=>$atrasados])->header('Content-Type', 'application/pdf');
    }

    // Lista de Turma para controle de camisas do interclasse
    public function printInterclasse(Turma $turma)
    {
      return response()->view('turmas.printinterclasse', ['turma'=>$turma])->header('Content-Type', 'application/pdf');
    }
}
