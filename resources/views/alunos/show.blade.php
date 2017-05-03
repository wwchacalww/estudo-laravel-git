@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Aluno</small>
    <small>{{$aluno->nome}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ url('alunos') }}"><i class="fa fa-user"></i> Alunos</a></li>
    <li class="active">{{$aluno->nome}}</li>
  </ol>
@endsection
@section('content')
<div class="row">
  <!-- Coluna Esquerda -->
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{$aluno->nome}} - [ {{ $aluno->matricula }} ]</h3>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            @if($aluno->turma != 'NULL')
              <dt>Turma</dt>
              <dd>
                {{ $aluno->turma->turma}}
              </dd>
            @endif

            <dt>Data de Nascimento</dt>
            <dd>
              @if($aluno->turma == NULL)
                {{ $dn->formatLocalized('%A %d de %B de %Y')}}
              @elseif($aluno->turma->serie == '6º Ano' && $dn->age > 12)
                <p class="text-danger">
                  {{ $dn->formatLocalized('%A %d de %B de %Y')}}, {{ $dn->age}} anos, {{ ($dn->age - 11) }} anos atrasado
                </p>
              @elseif($aluno->turma->serie == '7º Ano' && $dn->age > 13)
                <p class="text-danger">
                  {{ $dn->formatLocalized('%A %d de %B de %Y')}}, {{ $dn->age}} anos, {{ ($dn->age - 12) }} anos atrasado
                </p>
              @elseif($aluno->turma->serie == '8º Ano' && $dn->age > 14)
                <p class="text-danger">
                  {{ $dn->formatLocalized('%A %d de %B de %Y')}}, {{ $dn->age}} anos, {{ ($dn->age - 13) }} anos atrasado
                </p>
              @elseif($aluno->turma->serie == '9º Ano' && $dn->age > 15)
                <p class="text-danger">
                  {{ $dn->formatLocalized('%A %d de %B de %Y')}}, {{ $dn->age}} anos, {{ ($dn->age - 14) }} anos atrasado
                </p>
              @else
                <p class="text-info">
                  {{ $dn->formatLocalized('%A %d de %B de %Y')}}, {{ $dn->age}} anos
                </p>
              @endif
            </dd>

            <dt>Mãe</dt>
            <dd>{{$aluno->mae}}</dd>

            @if($aluno->pai != 'NULL')
              <dt>Pai</dt>
              <dd>{{$aluno->pai}}</dd>
            @endif

            <dt>CEP</dt>
            <dd>{{$aluno->cep}}</dd>

            <dt>Endereço</dt>
            <dd>{{$aluno->endereco}}</dd>

            <dt>Telefone</dt>
            <dd>{{ $aluno->telefone}}</dd>

          </dl>


        </div>
        <!-- /.box-body -->

    </div>

    @if(count($aluno->ocorrencias) > 0)
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Ocorrencias</h3>
        </div>
        <div class="box-body">
          @foreach($aluno->ocorrencias as $ocorrencia)
            <blockquote>
              <p>
                {{ $ocorrencia->tipo}}
              </p>
              <small>
                {{ Carbon::parse($ocorrencia->created_at)->formatLocalized('%A, %d de %B de %Y')}}, {{ $ocorrencia->equipe->funcao}} {{ $ocorrencia->equipe->user->name}} e
                {{ $ocorrencia->professor->sexo }} {{ $ocorrencia->professor->professor }} registraram a seguinte ocorrência: </br>
                <b> {{ $ocorrencia->descricao }}</b> <br>
                Tipo de infração: <br>
                @foreach($ocorrencia->indisciplinas as $indisciplina)
                  <b> - {{ $indisciplina->base}} - {{ $indisciplina->indisciplina }} </b><br>
                @endforeach

                @if(count($ocorrencia->alunos) > 1)
                  Alunos envolvidos: <br>
                  @foreach($ocorrencia->alunos as $pupilo)
                    <b>{{$pupilo->nome}}</b><br>
                  @endforeach
                @endif

                <a href="{{ url('ocorrencias/'.$ocorrencia->id.'/print')}}" class="btn btn-info btn-sm pull-right" role="button" target="_blank"><i class="fa fa-print"></i> | Imprimir</a>
              </small>
            </blockquote>
          @endforeach
        </div>
      </div>
    @endif

  </div>
  <!-- /Coluna Esquerda -->
  <!-- Coluna Direita -->
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Professores</h3>
      </div>

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>
                Professor
              </th>
              <th>
                Disciplina
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($aluno->turma->cargas as $carga)
              <tr>
                <td>
                  {{ $carga->professor->professor }}
                </td>
                <td>
                  @foreach($carga->disciplinas as $disciplina)
                    <b style="color:{{ $disciplina->cor }}">{{$disciplina->disciplina }}</b>
                  @endforeach
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Coluna Direita -->
</div>
@endsection
@section('jsScripts')
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>


@endsection
