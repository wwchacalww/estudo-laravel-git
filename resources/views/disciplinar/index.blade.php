@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Disciplinar</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Disciplinar</a></li>
  </ol>
@endsection

@section('content')
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-7 connectedSortable">
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Ocorrências</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        The body of the box
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /Coluna da Esquerda -->
  <!-- Coluna da Direitra  Indisciplinas -->
  <div class="col-lg-5 connectedSortable">

          <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Infrações</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul>
                <?php $base = ""; $bases = array();?>
              @foreach($indisciplinas->sortBy('base') as $infracao)
                @if($base != $infracao->base && $base == "")
                  <?php
                    $base = $infracao->base;
                    $bases[$infracao->base] = $infracao->base;
                  ?>
                  <li class="text-light-blue"><b>{{$infracao->base}}</b>
                    <ul>
                @elseif($base != $infracao->base)
                  <?php
                    $base = $infracao->base;
                    $bases[$infracao->base] = $infracao->base;
                  ?>
                    </ul>
                  </li>
                  <li class="text-light-blue"><b>{{$infracao->base}}</b>
                  <ul>
                @endif
                    <li>{{$infracao->indisciplina}}</li>
              @endforeach
                  </li>
                </ul>
              </ul>

              @if(Auth::check() && Auth::user()->isRole('diretor|administrador'))
                <hr>
                <h4>Nova Infração</h4>
                {!! Form::open(['route'=>'ocorrencias.indisciplinas.store','method' => 'post']) !!}
                <div class="row">
                  <div class="col-sm-4">

                    {!! Form::select('base', $bases, null, ['class' => 'form-control', 'placeholder'=>'Selecione a Base'] ) !!}
                  </div>
                  <div class="col-sm-7 input-group input-group-sm">

                    {!! Form::text('indisciplina', null, ['class'=>'form-control']) !!}
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat">Ok</button>
                    </span>
                  </div>
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


  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
