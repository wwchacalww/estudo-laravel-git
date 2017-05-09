@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Editar {{$aluno->nome}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('alunos.index') }}"><i class="fa fa-list"></i> Alunos</a></li>
    <li class="active">Editar {{$aluno->nome}}</li>
  </ol>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Editar {{$aluno->nome}}</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      {!! Form::open(['url'=>'alunos/'.$aluno->id.'/update', 'method'=>'put']) !!}

        <div class="box-body" id="formulario">
          @include('layouts.errors')

          <div class="form-group">
            <label for="exampleInputEmail1">Nome do aluno</label>
            <input type="text" class="form-control" placeholder="Nome do aluno" name="nome" value="{{$aluno->nome}}" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Matrícula</label>
            <input type="text" class="form-control" placeholder="Matrícula" name="matricula" value="{{$aluno->matricula}}" required>
          </div>

          <div class="form-group">
            <label>Data de Nascimento:</label>

            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="data_nascimento" name="dn" value="{{ Carbon::parse($aluno->dn)->format('d/m/Y') }}">
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Nome do Pai</label>
            <input type="text" class="form-control" placeholder="Nome do Pai" name="pai" value="{{$aluno->pai}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Nome da Mãe</label>
            <input type="text" class="form-control" placeholder="Nome da Mãe" name="mae" value="{{$aluno->mae}}" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">CEP</label>
            <input type="text" class="form-control" placeholder="CEP 99999-999" name="cep" id="cep" value="{{$aluno->cep}}" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Endereço</label>
            <input type="text" class="form-control" placeholder="Endereço" name="endereco" value="{{$aluno->endereco}}" id="endereco">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Telefone</label>
            <input type="text" class="form-control" placeholder="Telefone" value="{{$aluno->telefone}}" name="telefone">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Turma</label>
            {!! Form::select('turma_id', $turmas->pluck('turma','id'), $aluno->turma_id, ['placeholder'=>'Selecione um Turma', 'class' => 'form-control']) !!}
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Alterar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('jsScripts')
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('js/locales/datepicker-pt-BR.js')}}"></script>
  <!-- InputMask -->
  <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>

  <!-- Page script -->
  <script>
    $(function () {
      $('#data_nascimento').datepicker({
          language: 'pt-BR',
          autoclose: true
      });


      $('#data_nascimento').inputmask("99/99/9999");
      $('#cep').inputmask("99999-999");


    });
  </script>
@endsection
