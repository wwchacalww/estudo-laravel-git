<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisito;

class RequisitosController extends Controller
{
  /**
   * Visualiza, registra e edita o conteúdo programatico
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        $requisitos = Requisito::where('created_at', '>', '2018-01-01')->orderBy('habilidade')->get();
        $habilidades = ['Artes', 'Ciências', 'Educação Física', 'Geografia', 'História', 'Inglês', 'Matemática', 'Português'];
        return view('pedagogico.index', ['requisitos' => $requisitos, 'habilidades' =>$habilidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->validate( request(),[
        //     'name' => 'required|min:5|max:255',
        //     'email' => 'required|email|max:255|unique:users',
        //     'password' => 'required|min:6|confirmed'
        // ]);

        $data = $request->all();

        $user = Requisito::create($data);
        return redirect()->route('pedagogico.index');
    }
}
