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
    <small>Horario</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="#"><i class="fa fa-list"></i> Pedagógico</a></li>
    <li><i class="fa fa-feed"></i> Conselheiros</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-7 connectedSortable">
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Cargas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Carga</th>
            <th>CH</th>
            <th>Professor</th>
            <th>Turmas</th>
            <th>Editar</th>
          </tr>
          </thead>
          <tbody>
            @foreach($cargas as $carga)
              <tr>
                <td>
                  {{ $carga->carga }}
                </td>
                <td>
                  {{ $carga->ch}}
                </td>
                <td>
                  @if(count($carga->professor) > 0)
                    {{ $carga->professor->professor }}
                  @endif
                </td>
                @if($carga->turma_id == 0)
                  {!! Form::open(['url'=> 'pedagogico/conselheiros/'.$carga->id.'/add', 'method'=>'put']) !!}
                  <td>
                    <select class="form-control" name="turma">
                      @foreach($carga->turmas as $turma)
                        <option value="{{$turma->id}}">{{$turma->turma}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <button type="submit" name="button" class="btn btn-warning pull-right">Salvar</button>
                  </td>
                  </form>
                @else
                  <td>{{$carga->conselheiro->turma}}</td>
                  <td></td>
                @endif
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /Coluna da Esquerda -->
  <!-- Coluna da Direita -->
  <div class="col-lg-5 connectedSortable">
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Turmas</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Turma</th>
              <th>Conselheiro</th>
            </tr>
          </thead>
          <tbody>
            @foreach($turmas as $turma)
              <tr>
                <td>{{$turma->turma}}</td>
                <td>
                  <?php
                  $char = '';
                  foreach($turma->conselheiros as $conselheiro){
                    $char .= $conselheiro->professor->professor." | ";
                  }

                  $char = substr($char, 0, -2);
                  echo $char;
                   ?>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- /Coluna da Direita -->
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
