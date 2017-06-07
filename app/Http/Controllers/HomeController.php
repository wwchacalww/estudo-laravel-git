<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $turmas = Turma::where('ano', date('Y'))->get();
      $students['Total'] = 0;
      $students['Matutino']['total']= 0;
      $students['Vespertino']['total']=0;
      $students['Matutino']['atrasados']=0;
      $students['Vespertino']['atrasados']=0;
      $students['Atrasados'] = 0;
      $chart['Matutino']['turmas'] = array();
      $chart['Matutino']['total'] = array();
      $chart['Matutino']['atrasados'] = array();
      $chart['Matutino']['ocorrencias'] = array();
      $chart['Vespertino']['turmas'] = array();
      $chart['Vespertino']['total'] = array();
      $chart['Vespertino']['atrasados'] = array();
      $chart['Vespertino']['ocorrencias'] = array();
      $bos['Matutino']['infracao'] = array();
      $bos['Matutino']['base'] = array();
      $bos['Matutino']['total'] = 0;
      $bos['Vespertino']['infracao'] = array();
      $bos['Vespertino']['base'] = array();
      $bos['Vespertino']['total'] = 0;

      foreach($turmas as $turma){
        $tt = count($turma->alunos);
        $dis = 0;
        $ocorre = 0;
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
          if (count($pupilo->ocorrencias) > 0) {
            $ocorre++;
            foreach ($pupilo->ocorrencias as $ocorrencia) {
              $bos[$turma->turno]['total']++;
              foreach ($ocorrencia->indisciplinas as $infracao) {
                if(array_key_exists($infracao->indisciplina, $bos[$turma->turno]['infracao'])){
                  $bos[$turma->turno]['infracao'][$infracao->indisciplina]++;
                }else{
                  $bos[$turma->turno]['infracao'][$infracao->indisciplina] = 1;
                }

                if(array_key_exists($infracao->base, $bos[$turma->turno]['base'])){
                  $bos[$turma->turno]['base'][$infracao->base]++;
                }else{
                  $bos[$turma->turno]['base'][$infracao->base] = 1;
                }
              }
            }
          }
        }
        $students['Total'] += $tt;
        if($turma->turno == 'Matutino'){
          array_push($chart['Matutino']['turmas'], substr($turma->turma, 0, 5));
          array_push($chart['Matutino']['total'], $tt);
          array_push($chart['Matutino']['atrasados'], $dis);
          array_push($chart['Matutino']['ocorrencias'], $ocorre);
          $students['Matutino']['total'] += $tt;
        }else{
          array_push($chart['Vespertino']['turmas'], substr($turma->turma, 0, 5));
          array_push($chart['Vespertino']['total'], $tt);
          array_push($chart['Vespertino']['atrasados'], $dis);
          array_push($chart['Vespertino']['ocorrencias'], $ocorre);
          $students['Vespertino']['total'] += $tt;
        }
      }
      $chart['Matutino']['turmas'] = json_encode($chart['Matutino']['turmas']);
      $chart['Matutino']['total'] = json_encode($chart['Matutino']['total']);
      $chart['Matutino']['atrasados'] = json_encode($chart['Matutino']['atrasados']);
      $chart['Matutino']['ocorrencias'] = json_encode($chart['Matutino']['ocorrencias']);
      $chart['Vespertino']['turmas'] = json_encode($chart['Vespertino']['turmas']);
      $chart['Vespertino']['total'] = json_encode($chart['Vespertino']['total']);
      $chart['Vespertino']['atrasados'] = json_encode($chart['Vespertino']['atrasados']);
      $chart['Vespertino']['ocorrencias'] = json_encode($chart['Vespertino']['ocorrencias']);
      
      return view('welcome',['turmas'=>$turmas, 'students'=>$students, 'chart' => $chart, 'bos' => $bos ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
