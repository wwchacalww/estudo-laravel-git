<?php

namespace App\Http\Controllers;

use App\Carga;
use Illuminate\Http\Request;

class CargasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargas = Carga::all();
        $turmas = \App\Turma::where('ano',2017)->pluck('id','turma');
        return view('cargas.index',['cargas'=>$cargas, 'turmas'=>$turmas]);
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
            'carga' => 'required|min:5|max:25',
            'ch' => 'required|integer|min:2|max:60',
            'turmas' => 'required'
        ]);
        $data = $request->all();
        $carga = Carga::create($data);

        // Registrando turmas

        $carga->turmas()->attach($data['turmas']);

        return redirect()->route('horarios.cargas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function show(Carga $carga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function edit(Carga $carga)
    {

      $cargas = Carga::all();
      $turmas = \App\Turma::where('ano',2017)->pluck('id','turma');
      $enturmado = array();
      foreach ($carga->turmas as $value) {
         $enturmado[]= $value->id;
      }

      return view('cargas.edit',['cargas'=>$cargas, 'turmas'=>$turmas,  'carga_edit' => $carga, 'enturmado'=>$enturmado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carga $carga)
    {
      $this->validate( request(),[
          'carga' => 'required|min:5|max:25',
          'ch' => 'required|integer|min:2|max:60',
          'turmas' => 'required'
      ]);
      $data = $request->all();

      $carga->update($data);
      
      // Registrando turmas
      $carga->turmas()->detach();
      $carga->turmas()->attach($data['turmas']);

      return redirect()->route('horarios.cargas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carga $carga)
    {
        //
    }
}
