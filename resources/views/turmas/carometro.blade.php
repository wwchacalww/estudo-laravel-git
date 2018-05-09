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
    <small>Carômetro {{ $turma->turma }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('turmas.index') }}"><i class="fa fa-list-ul"></i> Turmas</a></li>
    <li class="active">Carômetro</li>
  </ol>
@endsection
@section('content')
<div class="row">

  <section class="col-lg-12 connectedSortable">
    <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $turma->turma }}</h3>

          <div class="box-tools pull-right">
            <span class="label label-info">{{ count($turma->alunos )}} Alunos</span>

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="users-list clearfix">
            @foreach( $turma->alunos->sortby('nome') as $aluno )
            <li>
              @if( File::exists( public_path().'/fotos/'.$aluno->matricula.'.jpg'))
              <img src="{{ asset('fotos/'.$aluno->matricula.'.jpg')}}" alt="{{$aluno->nome}}">
              @else
              <img src="{{ asset('img/semfoto.jpg')}}" alt="{{$aluno->nome}}">
              @endif
              <a class="users-list-name" href="{{ url('alunos/'.$aluno->id.'/show')}}">{{ $aluno->nome }}</a>
              <!-- <span class="users-list-date">Today</span> -->
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <!-- /.users-list -->
  </section>

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
