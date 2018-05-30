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
    <small>Passivos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li>Passivos</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-7 connectedSortable">
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Passivos</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        @if(!isset($passivos))
          <h3>Consulte o aluno no quadro ao lado</h3>
        @else
          <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Passivo</th>
              <th>Matricula</th>
              <th>Aluno</th>
            </tr>
            </thead>
            <tbody>
              @foreach($passivos as $passivo)
                <tr>
                  <td>{{$passivo->passivo}}</td>
                  <td>{{$passivo->matricula}}</td>
                  <td>{{$passivo->nome_aluno}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /Coluna da Esquerda -->
  <!-- Coluna da Direitra  Indisciplinas -->
  <div class="col-lg-5 connectedSortable">

          <div class="box box-danger box-solid" id="formulario">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              @if(Auth::check() && Auth::user()->isRole('secretaria|administrador'))
                @include('layouts.errors')

                {!! Form::open(['route'=>'passivos.consulta','method' => 'post']) !!}

                  <div class="form-group">
                    <label for="carga">Nome do Aluno</label>
                    <input type="text" class="form-control" name="consulta" >
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Consultar</button>
                  </div>

                </form>
              @endif

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

  </div>
  <!-- /Coluna da Direitra -->
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
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>

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
