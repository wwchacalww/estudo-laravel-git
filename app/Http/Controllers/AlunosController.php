<?php

namespace App\Http\Controllers;
use App\Aluno;
use Carbon;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    public function index(Request $request)
    {
      $data = $request->all();
      if(isset($data['q'])){
        $consulta = $data['q'];
        $busca = Aluno::where('nome', 'like', '%'.$consulta.'%')->whereHas('turma', function($query) { $query->where('ano', date('Y')); })->orderBy('turma_id', 'nome')->get();
      }else{
        $busca = 0;
      }
      //$alunos = Aluno::whereHas('turma', function($query) { $query->where('ano', date('Y')); })->orderBy('turma_id', 'nome')->get();

      return view('alunos.index', ['busca'=>$busca]);
    }

    public function create()
    {
      $turmas = \App\Turma::where('ano', date('Y'))->get();
      return view('alunos.create',['turmas'=>$turmas]);
    }

    public function store(Request $request)
    {
      $this->validate( request(),[
          'nome' => 'required|regex:/^[a-zA-Z][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/|min:12|max:25',
          'matricula' => 'required|integer|unique:alunos,matricula',
          'dn' => 'required',
          'pai' => 'required|regex:/^[a-zA-Z][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/',
          'mae' => 'required|regex:/^[a-zA-Z][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/',
          'cep' => 'required',
          'endereco' => 'required',
          'turma_id' => 'required|integer'
      ]);
      $data = $request->all();
      $x = explode("/", $data['dn']);
      $data['dn'] = $x[2]."-".$x[1]."-".$x[0];
      $aluno = Aluno::create($data);


      return redirect('alunos/'.$aluno->id.'/show');
    }

    public function edit(Aluno $aluno)
    {
      $turmas = \App\Turma::where('ano', date('Y'))->get();
      return view('alunos.edit', ['aluno' => $aluno, 'turmas'=>$turmas]);
    }

    public function update(Aluno $aluno, Request $request)
    {
      $this->validate( request(),[
          'nome' => 'required|regex:/^[a-zA-Z][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/|min:12|max:25',
          'matricula' => 'required|integer',
          'dn' => 'required',
          'pai' => 'required|regex:/^[a-zA-Z][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/',
          'mae' => 'required|regex:/^[a-zA-Z][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]*$/',
          'cep' => 'required',
          'endereco' => 'required',
          'turma_id' => 'required|integer'
      ]);
      $data = $request->all();
      $x = explode("/", $data['dn']);
      $data['dn'] = $x[2]."-".$x[1]."-".$x[0];
      $aluno->update($data);


      return redirect('alunos/'.$aluno->id.'/show');
    }

    public function apiSelectAluno(Request $request)
    {
      $data = $request->all();
      if(isset($data['q'])){
        $consulta = $data['q'];
      }else{
        $consulta = 'asdjfkaçslkjfelkfjslkj';
      }
      $alunos = Aluno::where('nome','like', $consulta.'%')->with('turma')->get();
      $items['items'] = array();
      foreach ($alunos as $aluno) {
        $items['items'][]=['id'=>$aluno->id, 'text'=>$aluno->nome.' - '.$aluno->turma->turma];
      }
      return $items;
    }

    public function show(Aluno $aluno)
    {
      setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
      $dn = Carbon::parse($aluno->dn);

      return  view('alunos.show',['aluno'=>$aluno , 'dn' => $dn]);
    }


}
