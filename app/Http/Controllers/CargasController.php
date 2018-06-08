<?php

namespace App\Http\Controllers;

use App\Carga;
use App\Turma;
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
        //$cargas = Carga::all();
        $cargas = Carga::where('created_at', '>', '2018-02-02 00:01:01')->get();
        $turmas = \App\Turma::where('ano', date('Y'))->pluck('id','turma');
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
      $turmas = \App\Turma::where('ano',date('Y'))->pluck('id','turma');
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

    public function teste()
    {
      // $cargas = Carga::all();
      // foreach ($cargas as $carga) {
      //   $carga->turmas()->detach();
      //   $carga_turmas = array();
      //   foreach ($carga->professor->disciplinas as $disciplina) {
      //     foreach ($disciplina->Turmas as $turma) {
      //       if (!in_array($turma->id, $carga_turmas)) {
      //         $carga_turmas[] = $turma->id;
      //       }
      //     }
      //   }
      //   $carga->turmas()->attach($carga_turmas);
      // }

      $disciplinas = \App\Disciplina::where('created_at','>','2018-01-01')->get();
      foreach ($disciplinas as $disciplina) {
        // $disciplina->carga_id = $disciplina->professor->cargas[0]->id;
        // $disciplina->update();
        echo "(".$disciplina->id.") ".$disciplina->disciplina." - ".$disciplina->professor->professor." ";
        foreach ($disciplina->professor->cargas as $value) {
          if($value->created_at > "2018-01-01 00:01:01"){
            if($disciplina->disciplina == "PORT3"){
              if ( $value->carga == "PORT3") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga." ";
              }
            }elseif($disciplina->disciplina == "CN3" ){
              if ($value->carga == "Ciências 3") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }
            }elseif($disciplina->disciplina == "PORT4" ){
              if ($value->carga == "Português 4") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->disciplina == "CN6" ){
              if ($value->carga == "Ciências 6") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->disciplina == "LEM2" ){
              if ($value->carga == "Inglẽs 2") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->id == "75" ){
              if ($value->carga == "PORT3") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->id == "80" ){
              if ($value->carga == "Inglês 2") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->id == "82" ){
              if ($value->carga == "PORT3") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->id == "88" ){
              if ($value->carga == "Inglês 2") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }elseif($disciplina->id >= "114" && $disciplina->id < 117 ){
              if ($value->carga == "Inglês 4") {
                $disciplina->carga_id = $value->id;
                $disciplina->update();
                echo $value->carga;
              }

            }else{
              $disciplina->carga_id = $value->id;
              $disciplina->update();
              echo $value->carga." ======= ";
            }

          }

        }
        echo "<br>";
      }

      return 'oi';
    }

    public function conselheiros()
    {
      $cargas = Carga::where('created_at', '>', '2018-01-01 00:01:01')->get();
      $turmas = Turma::where('ano', date('Y'))->orderBy('turno')->get();
      return view('pedagogico.conselheiros', ['cargas'=>$cargas, 'turmas' => $turmas]);
    }

    public function conselheirosAdd(Request $request, Carga $carga)
    {
      $data = $request->all();
      $carga->turma_id = $data['turma'];
      $carga->save();
      return redirect()->route('pedagogico.conselheiros');
    }
}
