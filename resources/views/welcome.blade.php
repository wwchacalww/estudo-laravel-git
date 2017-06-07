@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
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
    <small>Relatórios</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li class="active">Relatórios</li>
  </ol>
@endsection
@section('content')

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $students['Total']}}</h3>

            <p>Total de Alunos</p>
          </div>
          <div class="icon">
            <i class="ion ion-compose"></i>
          </div>
          <a href="{{route('turmas.index')}}" class="small-box-footer">Lista de Turmas&nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ $students['Matutino']['total']}}</h3>

            <p>Alunos do Matutino</p>
          </div>
          <div class="icon">
            <i class="ion ion-compose"></i>
          </div>
          <a href="{{route('turmas.index')}}" class="small-box-footer">Lista de Turmas&nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{$students['Vespertino']['total']}}</h3>

            <p>Alunos do Vespertino</p>
          </div>
          <div class="icon">
            <i class="ion ion-compose"></i>
          </div>
          <a href="{{route('turmas.index')}}" class="small-box-footer">Lista de Turmas &nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$students['Atrasados']}}</h3>

            <p>Alunos Distorção Idade/Série</p>
          </div>
          <div class="icon">
            <i class="ion ion-sad-outline"></i>
          </div>
          <a href="{{route('turmas.atrasadosPdf')}}" target="_blank" class="small-box-footer">Imprimir Relatório &nbsp; <i class="fa fa-print"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row" id="root">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        {{-- <div class="nav-tabs-custom">
          <!-- Tabs within a box -->
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
            <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
          </ul>
          <div class="tab-content no-padding">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
          </div>
        </div> --}}
        {{-- Gráfico de Turmas Matutino --}}
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Turmas Matutino</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              {{-- <canvas id="barChart" style="height:230px"></canvas> --}}
              <graph
                  :turmas="{{ $chart['Matutino']['turmas']}}"
                  :total="{{$chart['Matutino']['total']}}"
                  :atrasados="{{$chart['Matutino']['atrasados']}}"
                  :ocorrencias="{{$chart['Matutino']['ocorrencias']}}"
                ></graph>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        {{-- Gráfico de Turmas Vespertino --}}
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Turmas Vespertino</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              {{-- <canvas id="barChart" style="height:230px"></canvas> --}}
              <graph

              :turmas="{{ $chart['Vespertino']['turmas']}}"

              :total="{{$chart['Vespertino']['total']}}"

              :atrasados="{{$chart['Vespertino']['atrasados']}}"

              :ocorrencias="{{$chart['Vespertino']['ocorrencias']}}"

              ></graph>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.nav-tabs-custom -->


      </section>
      <!-- /.Left col -->


    </div>
    <!-- /.row (main row) -->
    <!-- Duas Colunas - Relatórios Disciplinar -->
    <div class="row">
      <!-- Relatório Disciplinar -->
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Tipos de Ocorrências</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-condensed">
              <tr>
                <th>Total de Ocorrências do Matutino <span class="badge bg-red">{{$bos['Matutino']['total']}}</span></th>
                <th style="width: 20%"></th>
                <th>%</th>
              </tr>
              @foreach($bos['Matutino']['infracao'] as $key => $value)
                <?php
                 $cor = 'rgb('.rand(0,200).', '.rand(0,200).', '.rand(0,200).')';
                ?>
                <tr>
                  <td>{{$key}} <span class="badge" style="background-color:{{$cor}}">{{$value}}</span></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar" style="width: {{ round((100*$value)/$bos['Matutino']['total'])}}%; background-color: {{$cor}}"></div>
                    </div>
                  </td>
                  <td><span class="badge" style="background-color:{{$cor}}">{{ round((100*$value)/$bos['Matutino']['total'])}}%</span></td>
                </tr>
              @endforeach
            </table>
              <hr>
            <table class="table table-condensed">
              <tr>
                <th>Total de Ocorrências do Vespertino <span class="badge bg-red">{{$bos['Vespertino']['total']}}</span></th>
                <th style="width: 20%"></th>
                <th>%</th>
              </tr>
              @foreach($bos['Vespertino']['infracao'] as $key => $value)
                <?php
                 $cor = 'rgb('.rand(0,200).', '.rand(0,200).', '.rand(0,200).')';
                ?>
                <tr>
                  <td>{{$key}} <span class="badge" style="background-color:{{$cor}}">{{$value}}</span></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar" style="width: {{ round((100*$value)/$bos['Vespertino']['total'])}}%; background-color: {{$cor}}"></div>
                    </div>
                  </td>
                  <td><span class="badge" style="background-color: {{$cor}}">{{ round((100*$value)/$bos['Vespertino']['total'])}}%</span></td>
                </tr>
              @endforeach
            </table>

          </div>
        </div>
      </div>
      <!-- /Relatório Disciplinar -->
      <!-- Relatório Rendimento -->
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Base das Ocorrências</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-condensed">
              <tr>
                <th>Total de Ocorrências do Matutino <span class="badge bg-red">{{$bos['Matutino']['total']}}</span></th>
                <th style="width: 20%"></th>
                <th>%</th>
              </tr>
              @foreach($bos['Matutino']['base'] as $key => $value)
                <?php
                 $cor = 'rgb('.rand(0,200).', '.rand(0,200).', '.rand(0,200).')';
                ?>
                <tr>
                  <td>{{$key}} <span class="badge" style="background-color:{{$cor}}">{{$value}}</span></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar" style="width: {{ round((100*$value)/$bos['Matutino']['total'])}}%; background-color: {{$cor}}"></div>
                    </div>
                  </td>
                  <td><span class="badge" style="background-color:{{$cor}}">{{ round((100*$value)/$bos['Matutino']['total'])}}%</span></td>
                </tr>
              @endforeach
            </table>
              <hr>
            <table class="table table-condensed">
              <tr>
                <th>Total de Ocorrências do Vespertino <span class="badge bg-red">{{$bos['Vespertino']['total']}}</span></th>
                <th style="width: 20%"></th>
                <th>%</th>
              </tr>
              @foreach($bos['Vespertino']['base'] as $key => $value)
                <?php
                 $cor = 'rgb('.rand(0,200).', '.rand(0,200).', '.rand(0,200).')';
                ?>
                <tr>
                  <td>{{$key}} <span class="badge" style="background-color:{{$cor}}">{{$value}}</span></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar" style="width: {{ round((100*$value)/$bos['Vespertino']['total'])}}%; background-color: {{$cor}}"></div>
                    </div>
                  </td>
                  <td><span class="badge" style="background-color: {{$cor}}">{{ round((100*$value)/$bos['Vespertino']['total'])}}%</span></td>
                </tr>
              @endforeach
            </table>

          </div>
        </div>
      </div>
      <!-- /Relatório Rendimento -->
    </div>
    <!-- /Duas Colunas - Relatórios Disciplinar -->

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

  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <!-- MainJs -->
  <script src="{{ asset('js/main.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
