<?php

namespace App\Http\Controllers;

use App\Empregado;
use Illuminate\Http\Request;
use PDF;
use Carbon;

class EmpregadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $empregados = Empregado::all();
        return view('empregados.index',['empregados'=>$empregados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empregados.create');
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
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users',
            'matricula' => 'required|max:10',
            'data_admissao' => 'required|max:12|date_format:d/m/Y',
            'endereco' => 'required|max:255',
            'ch' => 'required',
            'funcao' => 'required|max:255',
            'status' => 'required|max:8'
        ]);

        $data = $request->all();
        $x = explode("/", $data['data_admissao']);
        $data['data_admissao'] = $x[2]."-".$x[1]."-".$x[0];
        $empregado = Empregado::create($data);

        return redirect('empregados/'.$empregado->id.'/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empregado  $empregado
     * @return \Illuminate\Http\Response
     */
    public function show(Empregado $empregado)
    {
        // $empregado = Empregado::find($empregado);
        return view('empregados.show', ['empregado'=>$empregado]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empregado  $empregado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empregado $empregado)
    {
        return view('empregados.edit',['empregado'=>$empregado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empregado  $empregado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empregado $empregado)
    {
      $this->validate( request(),[
          'name' => 'required|min:5|max:255',
          'email' => 'required|email|max:255|unique:users',
          'matricula' => 'required|max:10',
          'data_admissao' => 'required|max:12|date_format:d/m/Y',
          'endereco' => 'required|max:255',
          'ch' => 'required',
          'funcao' => 'required|max:255',
          'status' => 'required|max:8'
      ]);

      $data = $request->all();
      $x = explode("/", $data['data_admissao']);
      $data['data_admissao'] = $x[2]."-".$x[1]."-".$x[0];


      $empregado->update($data);
      return redirect('empregados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empregado  $empregado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empregado $empregado)
    {
        //
    }

    public function apiServidor()
    {
      $servidores = Empregado::all();

      return $servidores;
    }

    public function apiEquipe()
    {
      $servidores = Empregado::with('equipe')->get();

      return $servidores;
    }

    public function status(Empregado $empregado)
    {
        if ($empregado->status == 'Ativo') {
          $empregado->status = 'Inativo';
        }else{
          $empregado->status = 'Ativo';
        }
        $empregado->update();
        return redirect()->back();

    }

    public function namo(Empregado $empregado)
    {
      return response()->view('empregados.namo',['empregado'=>$empregado])->header('Content-Type', 'application/pdf');
    }

    public function ponto(Request $request, Empregado $empregado)
    {
      $data = $request->all();
      $data = Carbon::Parse($data['ano'].'-'.$data['mes'].'-01');
      setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
      Carbon::setLocale('pt-br');
      //return strtoupper($data->formatLocalized('%B'));
      return response()->view('empregados.ponto',['empregado'=>$empregado, 'data'=>$data])->header('Content-Type', 'application/pdf');
    }
}
