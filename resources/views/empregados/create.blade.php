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
    Servidores
    <small>Novo Servidor</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('empregados.index') }}"><i class="fa fa-street-view"></i> Servidores</a></li>
    <li class="active">Novo Servidor</li>
  </ol>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Usuário</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      {!! Form::open(['route'=>'empregados.store', 'method'=>'post']) !!}

        <div class="box-body">
          @include('layouts.errors')

          <div class="form-group">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" id="exampleInputName" placeholder="Nome do usuário" name="name" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email do usuário" name="email" required>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Matrícula</label>
            <input type="text" class="form-control" placeholder="Matrícula do usuário" name="matricula" required>
          </div>

          <div class="form-group">
            <label>Data de Admissão:</label>

            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="data_admissao" name="data_admissao">
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <label for="">CPF</label>
            <input type="text" class="form-control" placeholder="CPF do usuário" name="cpf" id="cpf_mask" >
          </div>

          <div class="form-group">
            <label for="">RG</label>
            <input type="text" class="form-control" placeholder="RG do usuário" name="rg" >
          </div>

          <div class="form-group">
            <label for="">Endereço</label>
            <input type="text" class="form-control" placeholder="Endereço do usuário" name="endereco" required>
          </div>

          <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" class="form-control" placeholder="Telefone do usuário" name="telefone" required>
          </div>

          <div class="form-group">
            <label for="">Carga Horária</label>
            <select class="form-control"  name="ch">
              <option>20</option>
              <option>30</option>
              <option>40</option>
            </select>
          </div>

          <div class="form-group">
            <label >Função</label>
            <input type="text" class="form-control" placeholder="Função do usuário" name="funcao" required>
          </div>

          <div class="form-group">
            <label for="">Turno</label>
            <select class="form-control"  name="turno">
              <option>Matutino</option>
              <option>Vespertino</option>
              <option>Noturno</option>
            </select>
          </div>

          <div class="form-group">
            <label for="">Status</label>
            <select class="form-control"  name="status">
              <option>Ativo</option>
              <option>Inativo</option>
            </select>
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
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
  <!-- bootstrap datepicker -->
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('js/locales/datepicker-pt-BR.js')}}"></script>
  <!-- InputMask -->
  <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>

  <script>

  $(function(){
    //Date picker

  $('#data_admissao').datepicker({
      language: 'pt-BR',
      autoclose: true
    });
  });

  $('#cpf_mask').inputmask("999.999.999-99");
  $('#data_admissao').inputmask("99/99/9999");
  </script>

@endsection
