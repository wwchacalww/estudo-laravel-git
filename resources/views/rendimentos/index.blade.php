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
    <small>Rendimento Escolar</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('rendimentos.index') }}"><i class="fa fa-line-chart"></i> Renmento Escolar</a></li>

  </ol>
@endsection
@section('content')
<div class="row" id="app">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Lançamento de Notas e Faltas</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <h4>1º Bimestre - Controle de Lançamento de Notas</h4>
        <hr>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Turma</th>
              <th>ART</th>
              <th>CN</th>
              <th>EDF</th>
              <th>GEO</th>
              <th>HIST</th>
              <th>LEM</th>
              <th>MAT</th>
              <th>POR</th>
              <th>PDI</th>
              <th>PDII</th>
            </tr>
          </thead>
          <tbody>
            @foreach($turmas as $turma)
              <?php
                $art = 'fa-square-o';
                $cn = 'fa-square-o';
                $edf = 'fa-square-o';
                $geo = 'fa-square-o';
                $hist = 'fa-square-o';
                $lem = 'fa-square-o';
                $mat = 'fa-square-o';
                $por = 'fa-square-o';
                $pdi = 'fa-square-o';
                $pdii = 'fa-square-o';
              ?>
              @if(count($turma->alunos->first()->rendimentos) > 0)
                @foreach($turma->alunos->first()->rendimentos as $rendimento)
                  <?php
                  if($rendimento->disciplina->habilidade == "Artes" && $rendimento->bimestre == 1){ $art = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Ciências Naturais" && $rendimento->bimestre == 1){ $cn = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Educação Física" && $rendimento->bimestre == 1){ $edf = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Geografia" && $rendimento->bimestre == 1){ $geo = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "História" && $rendimento->bimestre == 1){ $hist = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Inglês" && $rendimento->bimestre == 1){ $lem = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Matemática" && $rendimento->bimestre == 1){ $mat = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Português" && $rendimento->bimestre == 1){ $por = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Práticas Diversificadas I" && $rendimento->bimestre == 1){ $pdi = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Práticas Diversificadas II" && $rendimento->bimestre == 1){ $pdii = 'fa-check-square-o'; }
                  ?>
                @endforeach
              @endif
              <tr>
                <td>{{$turma->turma}}</td>
                <td><i class="fa {{$art}}"></i></td>
                <td><i class="fa {{$cn}}"></i></td>
                <td><i class="fa {{$edf}}"></i></td>
                <td><i class="fa {{$geo}}"></i></td>
                <td><i class="fa {{$hist}}"></i></td>
                <td><i class="fa {{$lem}}"></i></td>
                <td><i class="fa {{$mat}}"></i></td>
                <td><i class="fa {{$por}}"></i></td>
                <td><i class="fa {{$pdi}}"></i></td>
                <td><i class="fa {{$pdii}}"></i></td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <hr>

        <h4>2º Bimestre - Controle de Lançamento de Notas</h4>
        <hr>
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Turma</th>
              <th>ART</th>
              <th>CN</th>
              <th>EDF</th>
              <th>GEO</th>
              <th>HIST</th>
              <th>LEM</th>
              <th>MAT</th>
              <th>POR</th>
              <th>PDI</th>
              <th>PDII</th>
            </tr>
          </thead>
          <tbody>
            @foreach($turmas as $turma)
              <?php
                $art = 'fa-square-o';
                $cn = 'fa-square-o';
                $edf = 'fa-square-o';
                $geo = 'fa-square-o';
                $hist = 'fa-square-o';
                $lem = 'fa-square-o';
                $mat = 'fa-square-o';
                $por = 'fa-square-o';
                $pdi = 'fa-square-o';
                $pdii = 'fa-square-o';
              ?>
              @if(count($turma->alunos->first()->rendimentos) > 0)
                @foreach($turma->alunos->first()->rendimentos as $rendimento)
                  <?php
                  if($rendimento->disciplina->habilidade == "Artes" && $rendimento->bimestre == 2){ $art = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Ciências Naturais" && $rendimento->bimestre == 2){ $cn = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Educação Física" && $rendimento->bimestre == 2){ $edf = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Geografia" && $rendimento->bimestre == 2){ $geo = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "História" && $rendimento->bimestre == 2){ $hist = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Inglês" && $rendimento->bimestre == 2){ $lem = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Matemática" && $rendimento->bimestre == 2){ $mat = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Português" && $rendimento->bimestre == 2){ $por = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Práticas Diversificadas I" && $rendimento->bimestre == 2){ $pdi = 'fa-check-square-o'; }
                  if($rendimento->disciplina->habilidade == "Práticas Diversificadas II" && $rendimento->bimestre == 2){ $pdii = 'fa-check-square-o'; }
                  ?>
                @endforeach
              @endif
              <tr>
                <td>{{$turma->turma}}</td>
                <td><i class="fa {{$art}}"></i></td>
                <td><i class="fa {{$cn}}"></i></td>
                <td><i class="fa {{$edf}}"></i></td>
                <td><i class="fa {{$geo}}"></i></td>
                <td><i class="fa {{$hist}}"></i></td>
                <td><i class="fa {{$lem}}"></i></td>
                <td><i class="fa {{$mat}}"></i></td>
                <td><i class="fa {{$por}}"></i></td>
                <td><i class="fa {{$pdi}}"></i></td>
                <td><i class="fa {{$pdii}}"></i></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
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
