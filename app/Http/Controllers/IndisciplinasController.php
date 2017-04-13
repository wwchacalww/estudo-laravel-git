<?php

namespace App\Http\Controllers;

use App\Indisciplina;
use Illuminate\Http\Request;

class IndisciplinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'oi';
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
        $data = $request->all();
        Indisciplina::create($data);
        return redirect()->route('ocorrencias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indisciplina  $indisciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Indisciplina $indisciplina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indisciplina  $indisciplina
     * @return \Illuminate\Http\Response
     */
    public function edit(Indisciplina $indisciplina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indisciplina  $indisciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indisciplina $indisciplina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indisciplina  $indisciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indisciplina $indisciplina)
    {
        //
    }
}
