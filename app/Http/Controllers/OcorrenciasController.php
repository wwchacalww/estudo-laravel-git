<?php

namespace App\Http\Controllers;

use App\Ocorrencia;
use App\Carga;
use App\Equipe;
use App\Indisciplina;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
        $ocorrencias = Ocorrencia::where('created_at','>','2018-01-01 00:00:01')->orderBy('created_at','desc')->get();
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
        $cargas = Carga::where('created_at','>', date('Y'))->get();
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
      $ocorrencias = Ocorrencia::where('created_at','>','2018-01-01 00:00:01')->orderBy('created_at','desc')->get();
      $cargas = Carga::where('created_at','>', date('Y'))->get();
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

    public function relatorio()
    {
      $ocorrencias = Ocorrencia::where('created_at','>','2018-01-01 00:00:01')->orderBy('created_at','desc')->get();
      //Dados
      $dados['total']['qnt'] = 0;
      $dados['turno']['Vespertino']['qnt'] = 0;
      $dados['turno']['Matutino']['qnt'] = 0;
      $dados[6]['qnt'] = 0;
      $dados[7]['qnt'] = 0;
      $dados[8]['qnt'] = 0;
      $dados[9]['qnt'] = 0;
      $dados['T']['qnt'] = 0;
      $dados['semana']['1']['qnt'] = 0;
      $dados['semana']['2']['qnt'] = 0;
      $dados['semana']['3']['qnt'] = 0;
      $dados['semana']['4']['qnt'] = 0;
      $dados['semana']['5']['qnt'] = 0;
      $dados['semana']['6']['qnt'] = 0;
      $dados['semana']['7']['qnt'] = 0;

      //Tipo de ocorrencia 'Advertência Oral','Advertência Escrita','Suspensão','Termo de Compromisso'
      $dados['tipo']['Advertência Oral']['qnt']=0;
      $dados['tipo']['Advertência Escrita']['qnt']=0;
      $dados['tipo']['Suspensão']['qnt']=0;
      $dados['tipo']['Termo de Compromisso']['qnt']=0;

      //Tipos de Infrações
      $dados['base'] = array();
      //Tipos de ocorrencias
      $dados['indisciplina'] = array();

      //Equipe
      $dados['equipe'] = array();

      foreach ($ocorrencias as $ocorrencia ) {
        //definindo o dia da Semana
        $dt = Carbon::parse($ocorrencia->created_at);

        foreach ($ocorrencia->alunos as $aluno) {
          $dados['turno'][$aluno->turma->turno]['qnt']++;
          $dados['total']['qnt']++;
          $dados['semana'][$dt->dayOfWeek]['qnt']++;
          $dados[$aluno->turma->serie[0]]['qnt']++;
          //Tipo Ocorrencia
          $dados['tipo'][$ocorrencia->tipo]['qnt']++;

          //Equipe
          if (!array_key_exists($ocorrencia->equipe->user->name, $dados['equipe'])) {
            $dados['equipe'][$ocorrencia->equipe->user->name]=1;
          }else{
            $dados['equipe'][$ocorrencia->equipe->user->name]++;
          }

          //Tipo de Infração
          foreach($ocorrencia->indisciplinas as $indisciplina){
            if (!array_key_exists($indisciplina->base, $dados['base'])) {
              $dados['base'][$indisciplina->base]['qnt'] = 1;
            }else{
              $dados['base'][$indisciplina->base]['qnt']++;
            }

            if (!array_key_exists($indisciplina->id, $dados['indisciplina'])) {
              $dados['indisciplina'][$indisciplina->id]['descricao'] = $indisciplina->indisciplina;
              $dados['indisciplina'][$indisciplina->id]['qnt'] = 1;
            }else{
              $dados['indisciplina'][$indisciplina->id]['qnt']++;
            }
          }
        }
      }
      //Organizando Equipe
      arsort($dados['equipe']);

        //Ajuste do Array
        foreach ($dados['equipe'] as $key => $value) {
          $dados['equipe']['key'][] = $key;
          $dados['equipe']['value'][] = $value;
        }

      //Organizando a ordem das infrações
      ksort($dados['base']);
      //Ajuste dos Alunos Transferidos
      $dados['turno']['Matutino']['qnt'] -= $dados['T']['qnt'];

      return response()->view('disciplinar.relatorio',['dados'=>$dados])->header('Content-Type', 'application/pdf');
    }
}
