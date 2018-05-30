<?php

namespace App\Http\Controllers;
use App\Passivo;
use Illuminate\Http\Request;

class PassivosController extends Controller
{
    public function index()
    {
      return view('passivos.index');
    }

    public function consulta(Request $data)
    {
      $consulta = $data['consulta'];
      if(strlen($consulta) > 5){
        $passivos = Passivo::where('nome_aluno', 'like', '%'.$consulta.'%')->orderBy('nome_aluno')->get();
        return view('passivos.index', ['passivos' => $passivos]);
      }else{
        return view('passivos.index');
      }
    }
}
