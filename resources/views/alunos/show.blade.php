@extends('layouts.dashboard')
@section('css')
  <!-- CSS do Boletim -->
  <link rel="stylesheet" href="{{asset('css/boletim.css')}}">
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

    <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue">
              <div class="widget-user-image">
                @if(File::exists(public_path().'/fotos/'.$aluno->matricula.'.jpg'))
                  <img class="img-circle" src="{{asset('fotos/'.$aluno->matricula.'.jpg')}}" alt="{{$aluno->nome}}">
                @else
                  <img class="img-circle" src="{{asset('img/semfoto.jpg')}}" alt="{{$aluno->nome}}">
                @endif

              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">{{$aluno->nome}} - [ {{$aluno->matricula}} ]</h3>
              <h5 class="widget-user-desc">{{$aluno->turma->turma}}</h5>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Opções</dt>
                <dd>
                  @if(Auth::check() && Auth::user()->hasPermission('update.aluno'))
                    <a href="{{url('alunos/'.$aluno->id.'/relatorio')}}" target="_blank" class="btn btn-warning btn-xs"> <i class="fa fa-list-ul"></i> | Relatório</a>
                    <a href="{{url('alunos/'.$aluno->id.'/edit')}}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> | Editar</a>
                  @endif

                </dd>
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
          <!-- /.widget-user -->



    {{-- Se tiver Ocorrencias --}}
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
                @if($ocorrencia->professor_id != NULL)
                  {{ Carbon::parse($ocorrencia->created_at)->formatLocalized('%A, %d de %B de %Y')}}, {{ $ocorrencia->equipe->funcao}} {{ $ocorrencia->equipe->user->name}} e
                  {{ $ocorrencia->professor->sexo }} {{ $ocorrencia->professor->professor }} registraram a seguinte ocorrência: </br>
                  <b> {{ $ocorrencia->descricao }}</b>
                @else
                  {{ Carbon::parse($ocorrencia->created_at)->formatLocalized('%A, %d de %B de %Y')}}, {{ $ocorrencia->equipe->funcao}} {{ $ocorrencia->equipe->user->name}}  registrou a seguinte ocorrência: </br>
                  <b> {{ $ocorrencia->descricao }}</b>
                @endif
                 <br>
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

    {{-- Se Tiver notas --}}
    @if(count($aluno->rendimentos->where('created_at', '>', '2018-01-01 00:01:01')) > 0)
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Boletim</h3>
        </div>
        <div class="box-body">
          <table class="table table-responsive table-boletim">
            <thead>
              <tr>
                <th rowspan="2">
                  Disciplina
                </th>
                <th colspan="2">1º Bimestre</th>
                <th colspan="2">2º Bimestre</th>
                <th colspan="2">3º Bimestre</th>
                <th colspan="2">4º Bimestre</th>
              </tr>
              <tr>
                <th>Nts</th><th>Flts</th>
                <th>Nts</th><th>Flts</th>
                <th>Nts</th><th>Flts</th>
                <th>Nts</th><th>Flts</th>
              </tr>
            </thead>
            <tbody>
              @foreach($disciplinas as $disciplina)
                <tr>
                  <th>
                    {{$disciplina}}
                  </th>
                  @if(count($boletim['primeiro'][$disciplina]) == 2)
                    <td><p class="text-{{ $boletim['primeiro'][$disciplina]['nota'] < 5 ? 'danger':'info' }}">{{$boletim['primeiro'][$disciplina]['nota']}}</p></td>
                    <td>{{$boletim['primeiro'][$disciplina]['faltas']}}</td>
                  @else
                    <td></td>
                    <td></td>
                  @endif

                  @if(count($boletim['segundo'][$disciplina]) == 2)
                    <td><p class="text-{{ $boletim['segundo'][$disciplina]['nota'] < 5 ? 'danger':'info' }}">{{$boletim['segundo'][$disciplina]['nota']}}</p></td>
                    <td>{{$boletim['segundo'][$disciplina]['faltas']}}</td>
                  @else
                    <td></td>
                    <td></td>
                  @endif

                  @if(count($boletim['terceiro'][$disciplina]) == 2)
                    <td><p class="text-{{ $boletim['terceiro'][$disciplina]['nota'] < 5 ? 'danger':'info' }}">{{$boletim['terceiro'][$disciplina]['nota']}}</p></td>
                    <td>{{$boletim['terceiro'][$disciplina]['faltas']}}</td>
                  @else
                    <td></td>
                    <td></td>
                  @endif

                  @if(count($boletim['quarto'][$disciplina]) == 2)
                    <td><p class="text-{{ $boletim['quarto'][$disciplina]['nota'] < 5 ? 'danger':'info' }}">{{$boletim['quarto'][$disciplina]['nota']}}</p></td>
                    <td>{{$boletim['quarto'][$disciplina]['faltas']}}</td>
                  @else
                    <td></td>
                    <td></td>
                  @endif

                </tr>

              @endforeach
            </tbody>
          </table>
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
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Horário</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        {{-- Capturando o Horário num array  --}}
        <?php

        foreach ($aluno->turma->horarios as $horario) {
          $horarios[$horario->horario][$horario->dia]= $horario->disciplina->habilidade;
        }

         ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th></th>
              <th>Segunda</th>
              <th>Terça</th>
              <th>Quarta</th>
              <th>Quinta</th>
              <th>Sexta</th>
            </tr>
          </thead>
          <tbody>
            @foreach($horarios as $key => $value)
              <tr>
                <td>{{$key}}º</td>
                <td>{{$value['Segunda']}}</td>
                <td>{{$value['Terça']}}</td>
                <td>{{$value['Quarta']}}</td>
                <td>{{$value['Quinta']}}</td>
                <td>{{$value['Sexta']}}</td>
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
