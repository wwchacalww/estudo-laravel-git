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
    <small>Lista de Turmas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('turmas.index') }}"><i class="fa fa-list-ul"></i> Turmas</a></li>
    <li class="active">Lista de Turmas</li>
  </ol>
@endsection
@section('content')
<div class="row">
  <!-- Coluna da Esquerda -->
  <section class="col-lg-6 connectedSortable">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Turmas Matutino</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="box-group" id="accordion-mat">
          <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
          @foreach($turmas as $turma)
            @if($turma->turno == 'Matutino')
              <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion-mat" href="#turma{{$turma->id}}">
                        {{$turma->turma}}
                      </a>
                      &nbsp;<a href="{{ url('turmas/'.$turma->id.'/printInterclasse')}}" target="_blank"><i class="fa fa-print"></i></a>
                    </h4>
                    <p class="pull-right"><font class="text-light-blue">
                      {{ count($turma->alunos) }} alunos</font>&nbsp;&nbsp;&nbsp;
                      @if($atrasados[$turma->id] == 1)
                        <font class="text-red">1 atrasado</font>
                      @elseif($atrasados[$turma->id] > 1)
                        <font class="text-red">{{$atrasados[$turma->id]}} atrasado</font>
                      @endif
                    </p>
                </div>
                <div id="turma{{$turma->id}}" class="panel-collapse collapse">
                  <div class="box-body">
                    <table id="table-matutino" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Aluno</th>
                        <th>Telefone</th>
                        <th>Idade</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($turma->alunos->sortby('nome') as $aluno)
                          <tr>
                            <td><a href="{{ url('alunos/'.$aluno->id.'/show')}}">{{$aluno->nome}}</a> </td>
                            <?php
                            $fone = explode("#", $aluno->telefone);
                            ?>
                            @if(count($fone) < 2)
                              <td>
                                {{ $aluno->telefone}}
                              </td>
                            @else
                              <td>
                                {!! Form::select('fone',$fone, null, ['class'=>'form-control']) !!}
                              </td>
                            @endif
                            {{-- <td>{{str_replace("#", "&nbsp;",$aluno->telefone)}}</td> --}}
                            <td>
                              @if($turma->serie == '6º Ano' && Carbon::parse($aluno->dn)->age > 12)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @elseif($turma->serie == '7º Ano' && Carbon::parse($aluno->dn)->age > 13)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @elseif($turma->serie == '8º Ano' && Carbon::parse($aluno->dn)->age > 14)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @elseif($turma->serie == '9º Ano' && Carbon::parse($aluno->dn)->age > 15)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @else
                                <p class="text-light-blue text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endif
          @endforeach

        </div>
      </div>

    </div>
  </section>
  <!-- /Coluna da Esquerda -->
  <!-- Coluna da Direita -->
  <section class="col-lg-6 connectedSortable">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Turmas Vespertino</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="box-group" id="accordion-vesp">
          <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
          @foreach($turmas as $turma)
            @if($turma->turno == 'Vespertino')
              <div class="panel box box-primary">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion-mat" href="#turma{{$turma->id}}">
                      {{$turma->turma}}
                    </a>
                    &nbsp;<a href="#" target="_blank"><i class="fa fa-print"></i></a>
                  </h4>
                  <p class="pull-right"><font class="text-light-blue">
                    {{ count($turma->alunos) }} alunos</font>&nbsp;&nbsp;&nbsp;
                    @if($atrasados[$turma->id] == 1)
                      <font class="text-red">1 atrasado</font>
                    @elseif($atrasados[$turma->id] > 1)
                      <font class="text-red">{{$atrasados[$turma->id]}} atrasado</font>
                    @endif

                  </p>

                </div>
                <div id="turma{{$turma->id}}" class="panel-collapse collapse">
                  <div class="box-body">
                    <table id="table-matutino" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Aluno</th>
                        <th>Telefone</th>
                        <th>Idade</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($turma->alunos->sortby('nome') as $aluno)
                          <tr>
                            <td><a href="{{ url('alunos/'.$aluno->id.'/show')}}">{{$aluno->nome}}</a></td>
                            <?php
                            $fone = explode("#", $aluno->telefone);
                            ?>
                            @if(count($fone) < 2)
                              <td>
                                {{ $aluno->telefone}}
                              </td>
                            @else
                              <td>
                                {!! Form::select('fone',$fone, null, ['class'=>'form-control']) !!}
                              </td>
                            @endif
                            {{-- <td>{{str_replace("#", "&nbsp;",$aluno->telefone)}}</td> --}}
                            <td>
                              @if($turma->serie == '6º Ano' && Carbon::parse($aluno->dn)->age > 12)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @elseif($turma->serie == '7º Ano' && Carbon::parse($aluno->dn)->age > 13)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @elseif($turma->serie == '8º Ano' && Carbon::parse($aluno->dn)->age > 14)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @elseif($turma->serie == '9º Ano' && Carbon::parse($aluno->dn)->age > 15)
                                <p class="text-red text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @else
                                <p class="text-light-blue text-center">{{Carbon::parse($aluno->dn)->age}}</p>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            @endif
          @endforeach

        </div>
      </div>

    </div>
  </section>
  <!-- /Coluna da Direita -->
</div>
@endsection


@section('jsScripts')
  <!-- jQuery 2.2.3 -->
  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>


  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
