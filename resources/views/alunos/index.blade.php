{{--
  Alunos

    Pesquisa de aluno por nome
    Lista de Turmas
    Relatórios
      Tabelas com Gráficos
        Total
          Alunos Regulares
          Alunos Atrasados
          Alunos Inidisciplinados
        Por Turno
          Alunos Regulares
          Alunos Atrasados
          Alunos Inidisciplinados
        Por Turmas
          Alunos Regulares
          Alunos Atrasados
          Alunos Inidisciplinados

--}}
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
    <small>Alunos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('turmas.index') }}"><i class="fa fa-list-ul"></i> Alunos</a></li>

  </ol>
@endsection
@section('content')

@if($busca !== 0)
  <div class="row">
    <div class="col-md-12">
       <div class="box box-{{ count($busca) > 0 ? 'success' : 'warning' }}">
         <div class="box-header with-border">
           <h3 class="box-title">Resultado da Pesquisa</h3>

           <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
           </div>
           <!-- /.box-tools -->
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           @if(count($busca) == 0)
             <h3>Não foi encontrado nenhum aluno com este nome.</h3>
           @else
             <?php
               $row = 0;
               ?>
             @foreach($busca as $aluno)
               @if( $row == 0)
                 <?php $row++; ?>
                 <div class="row">
                   <div class="col-md-6">
                     <!-- Widget: user widget style 1 -->
                     <div class="box box-widget widget-user-2">
                       <!-- Add the bg color to the header using any of the bg-* classes -->
                       <div class="widget-user-header bg-blue">
                         <div class="widget-user-image">
                           <img class="img-circle" src="{{ asset('/dist/img/user7-128x128.jpg')}}" alt="User Avatar">
                         </div>
                         <!-- /.widget-user-image -->
                          <a href="{{url('alunos/'.$aluno->id.'/show')}}" style="color:#FFF"><h3 class="widget-user-username">  {{$aluno->nome}}</h3></a>
                         <h5 class="widget-user-desc">{{$aluno->turma->turma }}</h5>
                       </div>
                       <div class="box-footer no-padding">
                         <ul class="nav nav-stacked">
                           <li><a href="#">Telefone: <b class="pull-right">{{$aluno->telefone}}</b></a> </li>
                           <li><a href="#">Nome da Mãe <b class="pull-right">{{$aluno->mae}}</b></a></li>
                           @if($aluno->pai != 'NULL')
                             <li><a href="#">Nome do Pai <b class="pull-right">{{$aluno->pai}}</b></a></li>
                           @endif

                           <li><a href="#">Ocorrências <span class="pull-right badge bg-{{ count($aluno->ocorrencia) == 0 ? 'blue' : 'red' }}">{{count($aluno->ocorrencias)}}</span></a></li>
                         </ul>
                       </div>
                     </div>
                     <!-- /.widget-user -->
                   </div>
               @elseif( $row == 1)
                   <div class="col-md-6">
                     <!-- Widget: user widget style 1 -->
                     <div class="box box-widget widget-user-2">
                       <!-- Add the bg color to the header using any of the bg-* classes -->
                       <div class="widget-user-header bg-blue">
                         <div class="widget-user-image">
                           <img class="img-circle" src="{{ asset('/dist/img/user7-128x128.jpg')}}" alt="User Avatar">
                         </div>
                         <!-- /.widget-user-image -->
                         <a href="{{url('alunos/'.$aluno->id.'/show')}}" style="color:#FFF"><h3 class="widget-user-username">{{$aluno->nome}}</h3></a>
                         <h5 class="widget-user-desc">{{$aluno->turma->turma }}</h5>
                       </div>
                       <div class="box-footer no-padding">
                         <ul class="nav nav-stacked">
                           <li><a href="#">Telefone: <b class="pull-right">{{$aluno->telefone}}</b></a> </li>
                           <li><a href="#">Nome da Mãe <b class="pull-right">{{$aluno->mae}}</b></a></li>
                           @if($aluno->pai != 'NULL')
                             <li><a href="#">Nome do Pai <b class="pull-right">{{$aluno->pai}}</b></a></li>
                           @endif

                           <li><a href="#">Ocorrências <span class="pull-right badge bg-{{ count($aluno->ocorrencias) === 0 ? 'blue' : 'red' }}">{{count($aluno->ocorrencias)}}</span></a></li>
                         </ul>
                       </div>
                     </div>
                     <!-- /.widget-user -->
                   </div>
                 </div>
                 <?php $row = 0; ?>
               @endif

             @endforeach
           @endif
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /.box -->
     </div>
  </div>



@endif


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
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
