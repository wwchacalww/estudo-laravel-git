<?php

namespace App\Http\Controllers;

use App\Professor;
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
        return view('professors.home',['professor'=>$professor, 'requisitos' => $requisitos]);
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
