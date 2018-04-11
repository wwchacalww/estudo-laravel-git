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
    <small>Pedagógico</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('horarios.cargas.index') }}"><i class="fa fa-list"></i> Pedagógico</a></li>
    <li>Conteúdo Programático</li>
  </ol>
@endsection

@section('content')
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-7 connectedSortable">
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Conteúdo Programático</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <h4 class="text-green">1º Bimestre</h4>

          @for($i = 6; $i <= 9; $i++)
            <blockquote >
              <h4 class="text-info">{{$i}}º Ano</h4>
              @foreach($requisitos as $requisito)
                @foreach($habilidades as $habilidade)
                    @if($requisito->habilidade == $habilidade && $requisito->serie == $i."º Ano")
                        <h4 class="box-title">{{$habilidade}}</h3>
                        <dl class="dl-horizontal">
                          <dt class="text-info">Conteúdo</dt>
                          <dd>{{$requisito->conteudo}}</dd>
                          <dt class="text-red">Pré-requisito</dt>
                          <dd>{{$requisito->pre_requisito}}</dd>
                        </dl>
                        <hr>
                    @endif
                @endforeach
              @endforeach
            </blockquote>
          @endfor
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
              <h3 class="box-title">Nova Conteúdo</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              @if(Auth::check() && Auth::user()->isRole('pedagogico|diretor|administrador'))
                @include('layouts.errors')

                {!! Form::open(['route'=>'pedagogico.requisitos.store','method' => 'post']) !!}

                <div class="form-group">
                  <label>Série / Ano</label>
                  <select class="form-control select2" data-placeholder="Selecione o Ano" style="width: 100%;" name="serie" required="required">

                      <option value="6º Ano">6º Ano</option>
                      <option value="7º Ano">7º Ano</option>
                      <option value="8º Ano">8º Ano</option>
                      <option value="9º Ano">9º Ano</option>

                  </select>
                </div>

                <div class="form-group">
                  <label>Bimestre</label>
                  <select class="form-control select2" data-placeholder="Selecione o Bismestre" style="width: 100%;" name="etapa" required="required">
                      <option value="1º Bimestre">1º Bimestre</option>
                      <option value="2º Bimestre">2º Bimestre</option>
                      <option value="3º Bimestre">3º Bimestre</option>
                      <option value="4º Bimestre">4º Bimestre</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="carga">Habilidade</label>
                  <select class="form-control select2" data-placeholder="Selecione o Bismestre" style="width: 100%;" name="habilidade" required="required">
                      <option value="Artes">Artes</option>
                      <option value="Ciências Naturais">Ciências</option>
                      <option value="Educação Física">Educação Física</option>
                      <option value="Geografia">Geografia</option>
                      <option value="História">História</option>
                      <option value="Inglês">Inglês</option>
                      <option value="Matemática">Matemática</option>
                      <option value="Português">Português</option>
                  </select>

                </div>

                <div class="form-group">
                  <label for="carga">Conteúdo</label>
                  <input type="text" class="form-control" name="conteudo" >
                </div>

                <div class="form-group">
                  <label>Pré-Requisito</label>
                  <input type="text" class="form-control" name="pre_requisito" >
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
