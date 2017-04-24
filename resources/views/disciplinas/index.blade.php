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
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
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
    <li><a href="{{ route('users.index') }}"><i class="fa fa-clock-o"></i> Horario</a></li>
    <li>Disciplinas</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-7 connectedSortable">
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Disciplinas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-striped" id="example1">
          <thead>
          <tr>
            <th width="20%">Disciplina</th>
            <th>Professor</th>
            <th>Turmas</th>
            <th>Editar</th>
          </tr>
          </thead>
          <tbody>
            @foreach($disciplinas as $disciplina)
              <tr>
                <td>
                  <b style="color:{{ $disciplina->cor }}">
                  {{ $disciplina->disciplina }}
                  </b>
                </td>
                <td>
                  {{ $disciplina->professor->professor}}
                </td>
                <td>
                  <select class="form-control">
                    @foreach($disciplina->turmas as $turma)
                      <option>{{$turma->turma}}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <a href="{{url('/horarios/disciplinas/'.$disciplina->id.'/edit')}}"><button type="button" name="button" class="btn btn-warning pull-right">Editar</button></a>
                </td>

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
  <!-- Coluna da Direitra  Indisciplinas -->
  <div class="col-lg-5 connectedSortable"  >


      <div class="box box-danger box-solid" id="formulario">
        <div class="box-header with-border">
          <h3 class="box-title">Nova Disciplina</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          @if(Auth::check() && Auth::user()->isRole('administrativo|diretor|administrador'))
            @include('layouts.errors')

            {!! Form::open(['route'=>'horarios.disciplinas.store','method' => 'post']) !!}

              <div class="form-group">
                <label for="carga">Disciplina</label>
                <input type="text" class="form-control" name="disciplina" >
              </div>
              <div class="form-group">
                <label for="carga">Habilidade</label>
                <input type="text" class="form-control" name="habilidade" >
              </div>
              <div class="form-group">
                <label>Cor</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" name="cor">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Professor</label>
                <disciplinas :disciplina_edit="0"></disciplinas>
              </div>

              <div class="form-group">
                <label>Turmas</label>


                <select class="form-control select2" multiple="multiple" data-placeholder="Selecione uma Turma" style="width: 100%;" name="turmas[]" required="required">
                  @foreach($turmas as $key => $value)
                    <option value="{{ $value }}">{{$key}}</option>
                  @endforeach
                </select>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
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
  <!-- DataTables -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


  <!-- Vue Component Seleciona_servidor -->
  <script src="{{asset('js/select_servidor.js')}}"></script>

  <!-- Page script -->
  <script>

    $(function () {
      //Initialize Select2 Elements

      $(".select2").select2();

      //color picker with addon
      $(".my-colorpicker2").colorpicker();

      $("#example1").DataTable({
        "language": {
            "url": "{{asset('plugins/datatables/lang/portugues.brazil.lang')}}"
        }
      });

    });



  </script>
@endsection
