<?php

namespace App\Http\Controllers;

use App\Rendimento;
use Illuminate\Http\Request;
use App\Turma;
use App\Aluno;
class RendimentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rendimentos = Rendimento::where([
          ['created_at', '>', date('Y').'-01-01 00:01:01'],
          ['created_at', '<', date('Y').'-12-31 00:01:01']
        ])->get();

        $turmas = Turma::where('ano', date('Y'))->get();
        return view('rendimentos.index', ['rendimentos' => $rendimentos, 'turmas' => $turmas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('rendimentos.create', ['turmas' => Turma::where('ano', date('Y'))->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $notas = file($request->file('notas'));
        $faltas = file($request->file('faltas'));


        //Manipulando arquivo Notas
        $boletim = array();
        foreach ($notas as $nota) {
          $x = explode(" ", str_replace("\r\n", "", $nota));
          $matricula = $x[0];
          for ($i=3; $i < count($x) ; $i++) {
            if (is_numeric($x[$i])) {
              $boletim[$matricula]['notas'][] = $x[$i];
            }
          }
        }
        //Manipulando Arquivo Faltas
        foreach ($faltas as $falta) {
          $x = explode(" ", str_replace("\r\n", "", $falta));
          $matricula = $x[0];
          for ($i=3; $i < count($x) ; $i++) {
            if (is_numeric($x[$i])) {
              $boletim[$matricula]['faltas'][] = $x[$i];
            }
          }
        }

        // Ajustando as Disciplinas num Array na ordem correta
        foreach($data['disciplinas'] as $disc){
          $x = explode('_', $disc);
          $materias[$x[0]] = $x[1];
        }
        ksort($materias);

        foreach ($materias as $key => $value) {
          $disciplina_id[] = $value;
        }

        // Salvando as notas e faltas
        foreach ($boletim as $matricula => $value) {

          // Verificar o ID do aluno
          $aluno = Aluno::where('matricula', $matricula)->first();
          if($aluno){
            //Salvando a nota do aluno

            for ($i=0; $i < count($disciplina_id); $i++) {
              $rendimento = Rendimento::updateOrCreate(
                  ['aluno_id' => $aluno->id, 'bimestre' => $data['bimestre'], 'disciplina_id' => $disciplina_id[$i]],
                  ['nota' => $boletim[$aluno->matricula]['notas'][$i], 'faltas' => $boletim[$aluno->matricula]['faltas'][$i]]
              );
            }

          }
          // for ($i=0; $i < count($value['notas']) ; $i++) {
          //
          //   echo "<td>".$value['notas'][$i]."</td>";
          //   echo "<td>".$value['faltas'][$i]."</td>";
          // }
          // echo "</tr>";

        }

        return redirect('rendimentos/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rendimento  $rendimento
     * @return \Illuminate\Http\Response
     */
    public function show(Rendimento $rendimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rendimento  $rendimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Rendimento $rendimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rendimento  $rendimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rendimento $rendimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rendimento  $rendimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rendimento $rendimento)
    {
        //
    }
}
