<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Horario;
use App\Turma;
use Illuminate\Http\Request;
use Auth;

class ProfessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professors = Professor::all();
        return view('professors.index',['professors'=>$professors]);
    }

    /**
     * Página pessoal do Professor
     *
     * @return \Illuminate\Http\Response
     */
    public function professor()
    {
      if (Auth::check() && !Auth::user()->isRole('professor')) {
        return redirect()->route('home');
      }
      $professor = Professor::where('empregado_id', Auth::user()->empregado['id'])->first();
      $requisitos = \App\Requisito::where('habilidade', $professor->habilidade)->orderBy('etapa', 'serie')->get();
      $series = [];
      foreach ($professor->disciplinas->where('ano', date('Y')) as $disciplina) {
        if ($disciplina->habilidade == $professor->habilidade) {
          foreach ($disciplina->turmas as $turma) {
            if(!in_array($turma->serie, $series)){
              $series[] = $turma->serie;
            }
          }
        }
      }
      return view('professors.home',['professor'=>$professor, 'requisitos' => $requisitos, 'series' => $series]);
    }

    /**
     * Página horario do Professor
     *
     * @return \Illuminate\Http\Response
     */
    public function horario()
    {
      if (Auth::check() && !Auth::user()->isRole('professor')) {
        return redirect()->route('home');
      }
        $professor = Professor::where('empregado_id', Auth::user()->empregado['id'])->first();
        // Montando o horário
        foreach($professor->cargas as $carga){
          if($carga->created_at > "2018-01-01 00:01:01"){
            for ($i=1; $i < 7 ; $i++) {
              $cargas[$carga->id][$i] = ['Segunda' => '', 'Terça' => '', 'Quarta' => '', 'Quinta' => '', 'Sexta' => '' ];
            }

            // Preenchendo o horario
            foreach ($carga->disciplinas as $disciplina){

              foreach($disciplina->horarios as $hora){
                  $cargas[$carga->id][$hora->horario][$hora->dia]= substr($hora->turma->turma, 0, 5)."($disciplina->disciplina)";
              }
            }
          }
        }



        // return $cargas;
        return view('professors.horario',['professor'=>$professor, 'cargas' => $cargas ]);
    }

    /**
     * Lista de turmas
     *
     * @return \Illuminate\Http\Response
     */
    public function turmas()
    {
        $professor = Professor::where('empregado_id', Auth::user()->empregado['id'])->first();
        return view('professors.turmas', ['professor'=>$professor]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function showturma(Turma $turma)
    {
        return view('professors.showturma', ['turma' => $turma]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function relatorio()
    {
      if (Auth::check() && !Auth::user()->isRole('professor')) {
        return redirect()->route('home');
      }
      $professor = Professor::where('empregado_id', Auth::user()->empregado['id'])->first();
      $requisitos = \App\Requisito::where('habilidade', $professor->habilidade)->orderBy('etapa', 'serie')->get();
      $series = [];
      foreach ($professor->disciplinas->where('ano', date('Y')) as $disciplina) {
        if ($disciplina->habilidade == $professor->habilidade) {
          foreach ($disciplina->turmas as $turma) {
            if(!in_array($turma->serie, $series)){
              $series[] = $turma->serie;
            }
          }
        }
      }
      return view('professors.relatorio',['professor'=>$professor, 'requisitos' => $requisitos, 'series' => $series]);
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
          'professor' => 'required|min:3|max:255',
          'habilidade' => 'required|max:35',
          'sexo' => 'required',
          'empregado_id' => 'required'
      ]);
      $data = $request->all();
      $professor = Professor::create($data);
      return redirect()->route('horarios.professors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //
    }

    public function apiProfessor()
    {
      $professors = Professor::all();

      return $professors;
    }
}
