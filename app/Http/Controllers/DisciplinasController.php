<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = \App\Turma::where('ano',date('Y'))->pluck('id','turma');

        $disciplinas = Disciplina::where('ano',date('Y'))->get();
        return view('disciplinas.index',['disciplinas'=>$disciplinas,'turmas'=>$turmas]);
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
          'disciplina' => 'required|min:3|max:10',
          'habilidade' => 'required|max:35',
          'cor' => 'required|min:7|max:7',
          'sala' => 'max:15',
          'professor_id' => 'required',
          'turmas' => 'required'
      ]);
      $data = $request->all();
      $data['ano'] = date('Y');

      $disciplina = Disciplina::create($data);

      // Registrando turmas

      $disciplina->turmas()->attach($data['turmas']);


      return redirect()->route('horarios.disciplinas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplina $disciplina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Disciplina $disciplina)
    {
      $turmas = \App\Turma::where('ano',date('Y'))->pluck('id','turma');
      $enturmado = array();
      foreach ($disciplina->turmas as $value) {
        $enturmado[]= $value->id;
      }

      $disciplinas = Disciplina::where('ano', date('Y'))->get();
      return view('disciplinas.edit',['disciplinas'=>$disciplinas,'turmas'=>$turmas, 'materia'=>$disciplina, 'enturmado' => $enturmado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disciplina $disciplina)
    {
      $this->validate( request(),[
          'disciplina' => 'required|min:3|max:10',
          'habilidade' => 'required|max:35',
          'cor' => 'required|min:7|max:7',
          'sala' => 'max:15',
          'professor_id' => 'required',
          'turmas' => 'required'
      ]);
      $data = $request->all();

      $disciplina->update($data);

      // Registrando turmas
      $disciplina->turmas()->detach();
      $disciplina->turmas()->attach($data['turmas']);


      return redirect()->route('horarios.disciplinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disciplina $disciplina)
    {
        //
    }
}
