@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Novo Usuário</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Usuários</a></li>
    <li class="active">Novo Usuário</li>
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
      {!! Form::open(['route'=>'users.store', 'method'=>'post']) !!}

        <div class="box-body" id="formulario">
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
            <label for="exampleInputRole">Função</label>
            {!! Form::select('role', $roles, 6,['class'=>'form-control']) !!}
          </div>

          <div class="form-group">
            <label>Servidor</label>
            <servidores :user_edit="0"></servidores>
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha" name="password" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirme a Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Senha" name="password_confirmation" required>
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
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!-- Vue Component Seleciona_servidor -->
  <script src="{{asset('js/select_servidor.js')}}"></script>
  <!-- Page script -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();


    });
  </script>
@endsection
