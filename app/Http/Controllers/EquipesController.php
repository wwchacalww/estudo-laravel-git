<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Carga;
use Illuminate\Http\Request;

class EquipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipes = Equipe::all();
        return view('equipes.index',['equipes'=>$equipes]);
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
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function show(Equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipe $equipe)
    {

        return view('equipes.edit',['equipe'=>$equipe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipe $equipe)
    {
        $data = $request->all();
        $equipe->empregado_id = $data['empregado_id'];
        $servidor = \App\Empregado::find($equipe->empregado_id);
        $equipe->user_id = $servidor->user_id;
        $equipe->update();
        return redirect()->route('equipes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipe $equipe)
    {
        //
    }

    /**
     * Lista para Consulta Pública
     *
     * @param \App\Equipe $equipe \App\Carga $cargas
     * @return \Illuminate\Http\Response
     */
     public function consultaPublicaPrint()
     {
       $equipes = Equipe::all();
       $cargas = Carga::where('created_at', '>', '2018-01-01 00:01:01')->get();

       return response()->view('equipes.consultaPublicaPrint', ['equipes'=>$equipes, 'cargas'=>$cargas])->header('Content-Type', 'application/pdf');
     }
}
