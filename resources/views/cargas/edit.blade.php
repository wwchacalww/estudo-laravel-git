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
    <li><a href="{{ route('horarios.cargas.index') }}"><i class="fa fa-clock-o"></i> Horario</a></li>
    <li><a href="{{ route('horarios.cargas.index') }}"><i class="fa fa-battery-half"></i> Cargas</a></li>
    <li>Editar Carga</li>
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
                <td>
                  <select class="form-control">
                    @foreach($carga->turmas as $turma)
                      <option>{{$turma->turma}}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <a href="{{url('/horarios/cargas/'.$carga->id.'/edit')}}"><button type="button" name="button" class="btn btn-warning pull-right">Editar</button></a>
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
  <div class="col-lg-5 connectedSortable">

          <div class="box box-success box-solid" id="formulario">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Carga {{ $carga_edit->carga }}</h3>

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

                {!! Form::open(['url'=>'horarios/cargas/'.$carga_edit->id.'/update','method' => 'put']) !!}

                  <div class="form-group">
                    <label for="carga">Carga</label>
                    <input type="text" class="form-control" name="carga" value="{{$carga_edit->carga}}" >
                  </div>
                  <div class="form-group">
                    <label for="carga">CH</label>
                    <input type="text" class="form-control" name="ch" value="{{ $carga_edit->ch }}" >
                  </div>

                  <div class="form-group">
                    <label>Professor</label>
                    @if($carga_edit->professor_id == null)
                        <disciplinas :disciplina_edit="0"></disciplinas>
                    @else
                        <disciplinas :disciplina_edit="{{ $carga_edit->professor_id }}"></disciplinas>
                    @endif

                  </div>

                  <div class="form-group">
                    <label>Turmas</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Selecione uma Turma" style="width: 100%;" name="turmas[]" required="required">
                      @foreach($turmas as $key => $value)
                        @if(in_array($value, $enturmado))
                          <option value="{{ $value }}" selected="selected">{{$key}}</option>
                        @else
                          <option value="{{ $value }}">{{$key}}</option>
                        @endif
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
