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
    <small>Equipe</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-gears"></i> Equipe</a></li>
    <li class="active">Equipe</li>
  </ol>
@endsection
@section('content')

<div class="row">
  <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Equipe</a></li>
          {{-- <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-user-plus"></i> &nbsp;Novo Usuário</a></li> --}}
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Função</th>
                <th>Usuário</th>
                <th>Servidor</th>
                <th>Email</th>
                <th>Editar</th>
              </tr>
              </thead>
              <tbody>
                @foreach($equipes as $equipe)
                  <tr>
                    <td>
                      {{ $equipe->funcao }}
                    </td>
                    <td>
                      @if(count($equipe->user))
                        {{ $equipe->user->name }}
                      @endif
                    </td>
                    <td>
                      @if(count($equipe->empregado))
                        {{ $equipe->empregado->name}}
                      @endif
                    </td>
                    <td>
                      @if(count($equipe->user))
                        {{ $equipe->user->email }}
                      @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        @if(Auth::check() && Auth::user()->hasPermission('update.user'))
                          <a href="#"><button type="button" class="btn btn-info">Edita</button></a>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>

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

  <!-- MainJs -->
  <script src="{{ asset('js/main.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
