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
        $ocorrencias = Ocorrencia::all();
        $cargas = Carga::all();
        $equipes = Equipe::whereNotNull('empregado_id')->get();
        return view('disciplinar.index',['ocorrencias'=>$ocorrencias, 'indisciplinas'=>$indisciplinas, 'base' => 0,  'cargas' => $cargas, 'equipes'=>$equipes]);
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
          'professor_id' =>'required|integer',
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
        //
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
        //
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
}
