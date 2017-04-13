@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
  <!-- On Off Toggle -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Lista de Servidores</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('empregados.index') }}"><i class="fa fa-street-view"></i> Servidor</a></li>
    <li class="active">Lista de Servidores</li>
  </ol>
@endsection
@section('content')

<div class="row">
  <div class="col-md-8" id="table_servidor">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Lista de Servidores</a></li>
          {{-- <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-user-plus"></i> &nbsp;Novo Usuário</a></li> --}}
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            {{-- <lista_servidores></lista_servidores> --}}
            <div class="box">

              <div class="box-body">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Função</th>
                    <th>CH</th>
                    @if(Auth::check() && Auth::user()->isRole('administrador|diretor|administrativo'))
                      <th>Opções</th>
                    @endif

                  </tr>
                  </thead>
                  <tbody>
                    @foreach($empregados as $task )
                      <tr>
                        <td><a href="{{url('empregados/'.$task->id.'/show')}}">{{$task->name }}</a> </td>
                        <td>{{$task->email}}</td>
                        <td>{{$task->funcao}}</td>
                        <td>{{$task->ch}}</td>

                        @if(Auth::check() && Auth::user()->isRole('administrador|diretor|administrativo'))
                          <td>
                            <div class="input-group-btn col-sm-12">
                              @if($task->status == 'Ativo')
                                <input type="checkbox" checked data-toggle="toggle" data-size="mini" data-on="Ativo" data-off="Inativo" onchange="javascript:location.href='{{url('empregados/'.$task->id.'/status')}}'" >
                              @else
                                <input type="checkbox" data-toggle="toggle" data-size="mini" data-on="Ativo" data-off="Inativo" onchange="javascript:location.href='{{url('empregados/'.$task->id.'/status')}}'" >
                              @endif
                              <a href="{{url('empregados/'.$task->id.'/edit')}}">
                                <button type="button" name="button" class="btn btn-xs btn-warning">Editar</button>
                              </a>
                              <a href="{{url('empregados/'.$task->id.'/namo')}}" target="_blank">
                                <button type="button" name="button" class="btn btn-xs btn-success">Namo</button>
                              </a>
                            </div>
                          </td>
                        @endif

                      </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Função</th>
                    <th>CH</th>
                    <th>Opções</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

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

  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- DataTables -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <!-- On Off toggle -->
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>

  <!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "language": {
          "url": "{{asset('plugins/datatables/lang/portugues.brazil.lang')}}"
      }
    });

  });
</script>
@endsection
