@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
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
      {!! Form::open(['url'=>'users/'.$user->id.'/update', 'method'=>'put']) !!}
        <div class="box-body" id="formulario">

          @include('layouts.errors')

          <div class="form-group">
            <label for="exampleInputEmail1">Nome</label>
            {!! Form::text('name', $user->name, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            {!! Form::email('email', $user->email, ['class'=>'form-control', 'required']) !!}
          </div>
          <div class="form-group">
            <label for="exampleInputRole">Função</label>
            {!! Form::select('role', $roles, $user->roles->pluck('id')[0],['class'=>'form-control']) !!}
          </div>

          <div class="form-group">
            <label>Servidor</label>
            @if(count($user->empregado))
                <servidores :user_edit="{{ $user->empregado->id }}"></servidores>
            @else
              <servidores :user_edit="0"></servidores>
            @endif

            {{-- <select class="form-control select2" style="width: 100%;">
              <option selected="selected">Alabama</option>
              <option value="2">Alaska</option>
              <option value="2">California</option>
              <option value="2">Delaware</option>
              <option value="2">Tennessee</option>
              <option value="2">Texas</option>
              <option value="2">Washington</option>
            </select> --}}
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
