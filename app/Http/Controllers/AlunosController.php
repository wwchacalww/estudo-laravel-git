<?php

namespace App\Http\Controllers;
use App\Aluno;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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



    public function fileTeste()
    {
      return view('alunos.fileTeste');
    }

    public function fileTesteStore(Request $request)
    {
      // $path = Storage::putFile('avatars', $request->file('alunos'));
      $contents = file($request->file('alunos'));
      $matriculado = array();
      foreach ($contents as $linha) {
        if (strlen($linha) < 5 && strlen($linha) > 2) {
          $turma_id = substr($linha, 0, 2);
          $turma = \App\Turma::find($turma_id);
          echo $turma->turma."<br>";
        }

        if (strlen($linha) > 10) {
          $x = explode(" ", $linha);
          $matricula = $x[0];
          $matriculado[]=$x[0];
          //echo $matricula."<br>";
          $aluno = Aluno::where('matricula',$matricula)->first();
          // echo count($aluno)."<br>";
          if(count($aluno) == 0){
            echo $linha." - <b> Não registrado </b><br>";
          }elseif(count($aluno) == 1 && $aluno->turma_id != $turma_id){
            echo $aluno->nome." pertence a turma ".$aluno->turma->turma."<br>";
            $aluno->update(['turma_id'=>$turma_id]);
          }
        }
      }

      //Verificando alunos Transferidos
      echo '<h1>Aluno transferidos</h1>';
      $alunos = Aluno::whereHas('turma', function($query) { $query->where('ano', date('Y')); })->orderBy('turma_id', 'nome')->get();
      foreach ($alunos as $aluno ) {
        if(!in_array($aluno->matricula, $matriculado)){
          $aluno->update(['turma_id'=> 37]);
          echo $aluno->matricula."<br />";
        }
      }

      //return $contents;
    }

    public function fileTesteNovo(Request $request)
    {
      // $path = Storage::putFile('avatars', $request->file('alunos'));
      $contents = file($request->file('alunos'));
      $ln = 0;
      foreach ($contents as $linha) {
        if (strlen($linha) < 5 && strlen($linha) > 1) {
          $data['turma_id'] = substr($linha, 0, 2);
          $turma = \App\Turma::find($data['turma_id']);
          echo $turma->turma."<br>";
          $ln = 1;
        }elseif($ln == 1){
          $x = explode(" ", $linha);
          echo "Matricula = ".$x[0]."<br>";
          $nome_aluno = "$x[1] $x[2]";
          for ($i=3; $i < count($x); $i++) {
            if(strpos($x[$i],"/") == false){
              $nome_aluno .= " $x[$i]";
            }else{
              $dn = substr($x[$i], 0, 10);
              $i = count($x);
            }
          }
          echo $nome_aluno."<br>";
          $dn = explode ("/", $dn);
          $data['dn'] = $dn['2'].'-'.$dn[1].'-'.$dn[0];
          echo "Data de nascimento = ".$data['dn']." <br>";

          $data['nome'] = $nome_aluno;
          $data['matricula'] = $x[0];
          $ln++;
        }
        elseif($ln == 2){
          echo "Pai = ".substr($linha, 0, -2)."<br>";
          $ln++;
          $data['pai'] = substr($linha, 0, -2);
        }
        elseif ($ln == 3) {
          $ln++;
          echo "Mãe = ".substr($linha, 0, -2)."<br>";
          $data['mae'] = substr($linha, 0, -2);
        }
        elseif ($ln == 4) {
          $ln++;
          $x = explode(" - ", $linha);
          echo 'CEP = '.$x[0]."<br>";
          // echo "Cidade = ".substr($x[1], 0, -2)."<br>";
          $data['cep'] = $x[0];
          $cidade = substr($x[1], 0, -2);
        }
        elseif ($ln == 5) {
          // echo "Endereço = $linha <br>";
          $ln++;
          $data['endereco'] = substr($linha, 0, -2).' - '.$cidade;
          echo $data['endereco']."<br>";
        }
        elseif ($ln == 6) {
          // echo "Telefone = $linha <br> <hr>";
          $ln = 1;
          $data['telefone'] = substr($linha, 0, -2);
          echo "Telefone ".$data['telefone']." <br><hr>";

          // Novo Aluno
          $newAluno = Aluno::firstOrCreate(['matricula'=>$data['matricula']], $data);
        }


      }
      //return $contents;
    }
}
