@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  {{-- <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Lista de Usuários</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Usuários</a></li>
    <li class="active">Lista de Usuários</li>
  </ol>
@endsection
@section('content')

<div class="row">
  <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Lista de Usuários</a></li>
          {{-- <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-user-plus"></i> &nbsp;Novo Usuário</a></li> --}}
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nome do Usuário</th>
                <th>Email</th>
                <th>Função</th>
                <th>Opções</th>
              </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>
                      {{ $user->name }}
                    </td>
                    <td>
                      {{ $user->email}}
                    </td>
                    <td>{{ $user->getRoles()[0] }}</td>
                    <td>
                      <div class="btn-group">
                        @if(Auth::check() && Auth::user()->hasPermission('update.user'))
                          <a href="{{url('users/'.$user->id.'/edit')}}"><button type="button" class="btn btn-info">Edita</button></a>
                        @endif
                        @if(Auth::check() && Auth::user()->hasPermission('delete.user'))
                          <a href="{{url('users/'.$user->id.'/destroy')}}" onclick="return confirm('Deseja deletar o usuário {{ $user->name}}?');"><button type="button" class="btn btn-danger">Apaga</button></a>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          <!-- /.tab-pane -->
          {{-- <div class="tab-pane" id="tab_2">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Novo Usuário</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route'=>'users.store', 'method'=>'post']) !!}
                <form role="form">
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
          </div> --}}
          <!-- /.tab-pane -->

        <!-- /.tab-content -->
        </div>
      <!-- nav-tabs-custom -->
      </div>

  </div>
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
  {{-- <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
