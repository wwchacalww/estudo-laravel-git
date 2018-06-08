@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
    Servidores
    <small>{{$empregado->name}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('empregados.index') }}"><i class="fa fa-street-view"></i> Servidores</a></li>
    <li class="active">{{ $empregado->name }}</li>
  </ol>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$empregado->name}} - {{ $empregado->matricula}}</h3>
          <div class="buttons pull-right">
            <a href="{{url('empregados/'.$empregado->id.'/edit')}}"> <i class="fa fa-edit"></i></a>Editar &nbsp;
            <i class="fa fa-trash-o"></i>Apagar
          </div>
        </div>
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt>Data de Admissão</dt>
            <?php $da = Carbon::parse($empregado->data_admissao); ?>
            <dd>{{$da->formatLocalized('%d / %m / %Y')}} ( {{$da->age}} anos de serviço )</dd>
            @if($empregado->cpf != '')
              <dt>CPF</dt>
              <dd>{{$empregado->cpf}}</dd>
            @endif
            @if($empregado->rg != '')
              <dt>RG</dt>
              <dd>{{$empregado->rg}}</dd>
            @endif
            <dt>Endereço</dt>
            <dd>{{$empregado->endereco}}</dd>
            <dt>Telefone</dt>
            <dd>{{$empregado->telefone}}</dd>
            <dt>Email</dt>
            <dd>{{$empregado->email}}</dd>
            <dt>CPF</dt>
            <dd>{{$empregado->cpf}}</dd>
            <dt>CH</dt>
            <dd>{{$empregado->ch}}</dd>
            <dt>Função</dt>
            <dd>{{$empregado->funcao}}</dd>
            <dt>Turno</dt>
            <dd>{{$empregado->turno}}</dd>
            <dt>Status</dt>
            <dd>
              @if($empregado->status == 'Ativo')
                  <input type="checkbox" checked data-toggle="toggle" data-size="mini" data-on="Ativo" data-off="Inativo" onchange="javascript:location.href='{{url('empregados/'.$empregado->id.'/status')}}'" >
              @else
                <input type="checkbox" data-toggle="toggle" data-size="mini" data-on="Ativo" data-off="Inativo" onchange="javascript:location.href='{{url('empregados/'.$empregado->id.'/status')}}'" >
              @endif
            </dd>

          </dl>


          <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarOptions">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="navbarOptions">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formulários <span class="caret"></span></a>
                   <ul class="dropdown-menu">
                     <li class="active"><a href="{{url('empregados/'.$empregado->id.'/namo')}}" target="_blank"><i class="fa fa-medkit"></i>Guia do Namo</a></li>
                     <li><a href="#"><i class="fa fa-plane"></i>Férias</a></li>
                     <li><a href="{{url('empregados/'.$empregado->id.'/avalia')}}" target="_blank"><i class="fa fa-bar-chart"></i>Avaliação de Temporário</a></li>

                   </ul>
                 </li>

                  <li><a href="#"></a></li>

                </ul>

                  {!! Form::open(['url'=>'empregados/'.$empregado->id.'/ponto', 'method'=>'post', 'class'=>'navbar-form navbar-left','target'=>'_blank']) !!}
                  <div class="form-group">

                    <label for="Folha de Ponto">Mes</label>
                    {!! Form::select('mes',[
                      '01'=>"Janeiro",
                      '02'=>"Fevereiro",
                      '03'=>"Março",
                      '04'=>"Abril",
                      '05'=>"Maio",
                      '06'=>"Junho",
                  		'07'=>"Julho",
                      '08'=>"Agosto",
                      '09'=>"Setembro",
                      '10'=>"Outubro",
                      '11'=>"Novembro",
                      '12'=>"Dezembro"
                    ], null,['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label for="ano">Ano</label>
                    {!! Form::select('ano',[

                      '2011'=>'2011',
                      '2012'=>'2012',
                      '2013'=>'2013',
                      '2014'=>'2014',
                      '2015'=>'2015',
                      '2016'=>'2016',
                      '2017'=>'2017',
                      '2018'=>'2018'
                    ], date('Y'),['class'=>'form-control']) !!}

                  </div>
                  <button type="submit" class="btn btn-primary">Folha de Ponto</button>

                </form>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"></a></li>

                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
          {{--
            <div class="form-group">
              <a href="{{url('empregados/'.$empregado->id.'/namo')}}" target="_blank"><button type="button" class="btn btn-info">
                <i class="fa fa-medkit"></i> | Guia do Namo
              </button></a>
            </div>
            {!! Form::open(['url'=>'empregados/'.$empregado->id.'/ponto', 'method'=>'post', 'class'=>'form-inline','target'=>'_blank']) !!}
            <div class="form-group">

              <label for="Folha de Ponto">Mes</label>
              {!! Form::select('mes',[
                '01'=>"Janeiro",
                '02'=>"Fevereiro",
                '03'=>"Março",
                '04'=>"Abril",
                '05'=>"Maio",
                '06'=>"Junho",
            		'07'=>"Julho",
                '08'=>"Agosto",
                '09'=>"Setembro",
                '10'=>"Outubro",
                '11'=>"Novembro",
                '12'=>"Dezembro"
              ], null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
              <label for="ano">Ano</label>
              {!! Form::select('ano',[
                '2010'=>'2010',
                '2011'=>'2011',
                '2012'=>'2012',
                '2013'=>'2013',
                '2014'=>'2014',
                '2015'=>'2015',
                '2016'=>'2016',
                '2017'=>'2017',
              ], date('Y'),['class'=>'form-control']) !!}

            </div>
            <button type="submit" class="btn btn-primary">Folha de Ponto</button>
            </form> --}}

        </div>
      </div>
  </div>
</div>
@endsection
@section('jsScripts')
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- On Off toggle -->
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <!-- Axios -->

@endsection
