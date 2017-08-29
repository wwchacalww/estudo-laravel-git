<?php

namespace App\Http\Controllers;

use App\Horario;
use Illuminate\Http\Request;
use Carbon;
use App\Turma;
use App\Carga;
class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::whereHas('turma', function($query){
          $query->where('ano', date('Y'));
        })->orderBy('turma_id','dia', 'horario')->get();

        $cargas = Carga::where([
          ['created_at','>', date('Y').'-01-01 00:01:01'],
          ['created_at','<', date('Y').'-12-31 00:01:01']
        ])->get();
        $turmas = Turma::where('ano', date('Y'))->orderBy('turno','turma')->get();

        return view('horarios.index', ['horarios'=>$horarios, 'turmas' => $turmas, 'cargas'=>$cargas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horarios = Horario::whereHas('turma', function($query) {
          $query->where('ano', date('Y'));
        })->orderBy('turma_id','dia','horario')->get();

        $turmas = \App\Turma::where('ano', date('Y'))->orderBy('turno','turma')->get();

        return view('horarios.create',['horarios'=>$horarios,'turmas'=>$turmas]);
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
          'turma_id' => 'required',
          'dia' => 'required',
          'disciplina_id' => 'required',
          'horario' => 'required'
      ]);

        $data = $request->all();
        Horario::create($data);
        return ['message'=>'Horário Registrado'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }

    public function apiTurmaDisciplina(Request $request)
    {
      $data = $request->all();
      if(isset($data['q'])){
        $consulta = $data['q'];
      }else{
        $consulta = 'asdjfkaçslkjfelkfjslkj';
      }
      $turma = \App\Turma::find($consulta);

      if(count($turma) == 1){
        return $turma->disciplinas;
      }
    }

    public function apiHorario(Request $request)
    {
      $data = $request->all();
      if(isset($data['turno'])){
        $turno = $data['turno'];
        $turmas = \App\Turma::where(['ano'=> date('Y'), 'turno'=>$turno])->orderBy('turma')->get();
        $horario = array();
        for($i = 2; $i<= 6; $i++){
          for ($j=1; $j <= 6 ; $j++) {
            foreach ($turmas as $turma) {
              $horario[$i][$j][str_replace("º ", "", substr($turma->turma, 0, 5))]['disciplina']="";
              $horario[$i][$j][str_replace("º ", "", substr($turma->turma, 0, 5))]['cor']="";
            }
          }
        }

        $grades = Horario::whereHas('turma', function($query) {
          $query->where(['ano'=> date('Y')]);
        })->orderBy('turma_id','dia','horario')->get();

        foreach ($grades as $grade ) {
          if($grade->dia == 'Segunda' && $grade->turma->turno == $turno){
            $horario[2][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['disciplina'] = $grade->disciplina->disciplina;
            $horario[2][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['cor'] = $grade->disciplina->cor;
          }elseif($grade->dia == 'Terça' && $grade->turma->turno == $turno){
            $horario[3][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['disciplina'] = $grade->disciplina->disciplina;
            $horario[3][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['cor'] = $grade->disciplina->cor;
          }elseif($grade->dia == 'Quarta' && $grade->turma->turno == $turno){
            $horario[4][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['disciplina'] = $grade->disciplina->disciplina;
            $horario[4][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['cor'] = $grade->disciplina->cor;
          }elseif($grade->dia == 'Quinta' && $grade->turma->turno == $turno){
            $horario[5][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['disciplina'] = $grade->disciplina->disciplina;
            $horario[5][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['cor'] = $grade->disciplina->cor;
          }elseif($grade->dia == 'Sexta' && $grade->turma->turno == $turno){
            $horario[6][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['disciplina'] = $grade->disciplina->disciplina;
            $horario[6][$grade->horario][str_replace("º ", "", substr($grade->turma->turma, 0, 5))]['cor'] = $grade->disciplina->cor;
          }
        }

        return $horario;
      }

    }

    public function apiProfessorHorario(Request $request)
    {
      $data = $request->all();
      if(isset($data['q'])){
        $carga = Carga::find($data['q']);
        $horario['professor'] = $carga->professor->professor;
        for ($i=1; $i < 7 ; $i++) {
          if ($i == 1) {  $horario['Primeiro'] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ]; }
          if ($i == 2) {  $horario['Segundo'] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ]; }
          if ($i == 3) {  $horario['Terceiro'] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ]; }
          if ($i == 4) {  $horario['Quarto'] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ]; }
          if ($i == 5) {  $horario['Quinto'] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ]; }
          if ($i == 6) {  $horario['Sexto'] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ]; }
        }

        // $turmas = Turma::where('turno', 'Matutino')->get();
        // foreach ($turmas as $turma ) {
        //   foreach($turma->horarios as $hora){
        //     if($hora->disciplina->id > 27){
        //       $teste[]=[
        //         'id' => $hora->id,
        //         'disciplina_id' => $hora->disciplina_id,
        //         'disciplina' => $hora->disciplina->disciplina,
        //         'turma' => $turma->turma
        //       ];
        //     }
        //   }
        // }
        // dd($teste);
        foreach ($carga->disciplinas as $disciplina) {
          foreach ($disciplina->horarios as $hora) {
            if($hora->horario == 1){ $tempo = 'Primeiro';}
            if($hora->horario == 2){ $tempo = 'Segundo';}
            if($hora->horario == 3){ $tempo = 'Terceiro';}
            if($hora->horario == 4){ $tempo = 'Quarto';}
            if($hora->horario == 5){ $tempo = 'Quinto';}
            if($hora->horario == 6){ $tempo = 'Sexto';}
            $horario[$tempo][$hora->dia]= substr($hora->turma->turma, 0, 5)."($disciplina->disciplina)";

          }

        }

        return $horario;
      }
    }

    public function teste()
    {

      $segundo = 'HIST3
EF3
GEO3
POR4
MAT4
CN4
MAT5
PDIII 1
POR5
CN5
LEM3
HIST4
MAT6
POR6
GEO4
PDII 3
PDIII 2
CN6
';
    $segundo = preg_split('/\n|\r\n?/', $segundo);
    $segundo = array_slice($segundo, 0, -1);
    $turmas = \App\Turma::where(['ano'=> date('Y'), 'turno'=>'Vespertino'])->orderBy('turma')->get();
    $i = 0;
    foreach($segundo as $segunda){
      $d = \App\Disciplina::where('disciplina', $segunda)->first();
      $disciplinas[] = $d->id;

    }
    foreach ($turmas as $turma) {
      $data[] = ['turma_id' => $turma->id, 'dia' => 'Sexta', 'horario' => 6, 'disciplina_id' => $disciplinas[$i], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ];
      $i++;
    }

    // Horario::insert($data);
      return $data;
    }
}
