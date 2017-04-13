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
      $turmas = Turma::all();
      $students['Total'] = 0;
      $students['Matutino']['total']= 0;
      $students['Vespertino']['total']=0;
      $students['Matutino']['atrasados']=0;
      $students['Vespertino']['atrasados']=0;
      $students['Atrasados'] = 0;
      $chart['Matutino']['turmas'] = array();
      $chart['Matutino']['total'] = array();
      $chart['Matutino']['atrasados'] = array();
      $chart['Vespertino']['turmas'] = array();
      $chart['Vespertino']['total'] = array();
      $chart['Vespertino']['atrasados'] = array();
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
          array_push($chart['Matutino']['turmas'], substr($turma->turma, 0, 5));
          array_push($chart['Matutino']['total'], $tt);
          array_push($chart['Matutino']['atrasados'], $dis);
          $students['Matutino']['total'] += $tt;
        }else{
          array_push($chart['Vespertino']['turmas'], substr($turma->turma, 0, 5));
          array_push($chart['Vespertino']['total'], $tt);
          array_push($chart['Vespertino']['atrasados'], $dis);
          $students['Vespertino']['total'] += $tt;
        }
      }
      $chart['Matutino']['turmas'] = json_encode($chart['Matutino']['turmas']);
      $chart['Matutino']['total'] = json_encode($chart['Matutino']['total']);
      $chart['Matutino']['atrasados'] = json_encode($chart['Matutino']['atrasados']);
      $chart['Vespertino']['turmas'] = json_encode($chart['Vespertino']['turmas']);
      $chart['Vespertino']['total'] = json_encode($chart['Vespertino']['total']);
      $chart['Vespertino']['atrasados'] = json_encode($chart['Vespertino']['atrasados']);

      return view('welcome',['turmas'=>$turmas, 'students'=>$students, 'chart' => $chart ]);
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
