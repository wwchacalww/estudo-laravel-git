<?php

namespace App\Http\Controllers;

use App\Ocorrencia;
use App\Carga;
use App\Equipe;
use App\Indisciplina;
use Illuminate\Http\Request;


class OcorrenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $indisciplinas = Indisciplina::whereNotNull('base')->orderBy('base')->get();
        $ocorrencias = Ocorrencia::where('created_at','<','2018-01-01 00:00:01')->orderBy('created_at','desc')->get();
        //Dados
        $dados['total'] = 0;
        $dados['Matutino']['qnt'] = 0;
        $dados['Vespertino']['qnt'] = 0;
        $dados['chartOcorrencia']['data']= array();
        $dados['chartOcorrencia']['total']= array();

        foreach ($ocorrencias as $ocorrencia ) {
          foreach ($ocorrencia->alunos as $aluno) {
            $dados[$aluno->turma->turno]['qnt']++;
            $dados['total']++;
            if(!in_array(substr($ocorrencia->created_at, 0, 10), $dados['chartOcorrencia']['data'])){
              $dados['chartOcorrencia']['data'][]=substr($ocorrencia->created_at, 0, 10);
              $dados['temp'][substr($ocorrencia->created_at, 0, 10)] = 1;
            }else{
              $dados['temp'][substr($ocorrencia->created_at, 0, 10)]++;
            }
          }
        }

        foreach($dados['temp'] as $dado){
          $dados['chartOcorrencia']['total'][]=$dado;
        }
        $dados['Vespertino']['porcento'] =  ($dados['Vespertino']['qnt'] * 100) / $dados['total'];
        $dados['Matutino']['porcento'] =  ($dados['Matutino']['qnt'] * 100) / $dados['total'];
        $cargas = Carga::all();
        $equipes = Equipe::whereNotNull('empregado_id')->get();

        return view('disciplinar.index',[
            'ocorrencias'=>$ocorrencias,
            'indisciplinas'=>$indisciplinas,
            'base' => 0,
            'cargas' => $cargas,
            'equipes'=>$equipes,
            'dados' => $dados
        ]);
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
      $this->validate( request(),[
          'alunos' => 'required',
          
          'equipe_id' => 'required|integer',
          'tipo' => 'required',
          'indisciplinas' => 'required',
          'descricao' => 'required'
      ]);

      $data = $request->all();

      $ocorrencia = Ocorrencia::create($data);

      // Anexando os Alunos
      $ocorrencia->alunos()->attach($data['alunos']);

      // Anexando Indisciplinas
      $ocorrencia->indisciplinas()->attach($data['indisciplinas']);


      return redirect()->route('ocorrencias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function show(Ocorrencia $ocorrencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Ocorrencia $ocorrencia)
    {
      $indisciplinas = Indisciplina::whereNotNull('base')->orderBy('base')->get();
      $ocorrencias = Ocorrencia::where('created_at','<','2018-01-01 00:00:01')->orderBy('created_at','desc')->get();
      $cargas = Carga::all();
      $equipes = Equipe::whereNotNull('empregado_id')->get();
      return view('disciplinar.edit',['ocorrencias'=>$ocorrencias, 'indisciplinas'=>$indisciplinas, 'base' => 0,  'cargas' => $cargas, 'equipes'=>$equipes, 'bo'=>$ocorrencia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ocorrencia $ocorrencia)
    {
      $this->validate( request(),[
          'alunos' => 'required',
          'created_at' => 'required',
          'professor_id' =>'required|integer',
          'equipe_id' => 'required|integer',
          'tipo' => 'required',
          'indisciplinas' => 'required',
          'descricao' => 'required'
      ]);

      $data = $request->all();
      $x = explode("/", $data['created_at']);
      $data['created_at'] = $x[2]."-".$x[1]."-".$x[0].' 00:00:01';



      $ocorrencia->update($data);

      // Anexando os Alunos

      $ocorrencia->alunos()->detach();
      $ocorrencia->alunos()->attach($data['alunos']);

      // Anexando Indisciplinas
      $ocorrencia->indisciplinas()->detach();
      $ocorrencia->indisciplinas()->attach($data['indisciplinas']);


      return redirect()->route('ocorrencias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ocorrencia  $ocorrencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ocorrencia $ocorrencia)
    {
        //
    }

    public function print(Ocorrencia $ocorrencia)
    {
      return response()->view('disciplinar.print',['ocorrencia'=>$ocorrencia])->header('Content-Type', 'application/pdf');
    }
}
