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
    <li><a href="{{ route('ocorrencias.index') }}"><i class="fa fa-balance-scale"></i> Disciplinar</a></li>
  </ol>
@endsection

@section('content')
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-7 connectedSortable" id="vueModal">
    @if(Auth::check() && Auth::user()->hasPermission('create.disciplinar'))
    <!-- Nova ocorrencia -->
    <div class="box box-warning box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Nova Ocorrência</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body" >
        @include('layouts.errors')
        {!! Form::open(['route'=>'ocorrencias.store', 'method'=>'post']) !!}
        <div class="form-group">
          <label for="alunos">Aluno</label>
          {{-- <alunos aluno_edit="0"></alunos> --}}
          <select class="form-control select2" id="aluno_select" multiple="multiple" data-placeholder="Alunos" style="width: 100%;" name="alunos[]" required="required">
          </select>

        </div>

        <div class="form-group">
          <label for="professor">Professor</label>
          <select class="form-control select2" id="professor_select" style="width: 100%;" name="professor_id" >
            <option></option>
            @foreach($cargas as $carga )
              <option value="{{$carga->professor_id}}">
                {{$carga->professor->professor}} -
                @foreach($carga->professor->disciplinas as $disciplina)
                  {{ $disciplina->disciplina }}
                @endforeach
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="professor">Membro da Direção</label>
          <select class="form-control select2" id="equipe_select" style="width: 100%;" name="equipe_id" required="required" >
            <option></option>
            @foreach($equipes as $equipe )
              <option value="{{$equipe->id}}">{{$equipe->funcao}} - {{$equipe->user->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="professor">Medida Disciplinar</label>
          <select class="form-control" name="tipo" required="required" >
              <option>Advertência Oral</option>
              <option>Advertência Escrita</option>
              <option>Suspensão</option>
              <option>Termo de Compromisso</option>
          </select>
        </div>

        <div class="form-group">
          <label for="professor">Infrações</label>
          <select class="form-control select2" id="indisciplina_select" multiple="multiple" data-placeholder="Infrações" style="width: 100%;" name="indisciplinas[]" >
            @foreach($indisciplinas as $indisciplina)
              @if($base === 0)
                <?php
                  $base = $indisciplina->base;
                ?>
                <optgroup label="{{$base}}">
                  <option value="{{$indisciplina->id}}">{{$indisciplina->indisciplina}}</option>
              @elseif($base !== $indisciplina->base)
                <?php $base = $indisciplina->base; ?>
                </optgroup>
                <optgroup label="{{$indisciplina->base}} {{$base}}">
                  <option value="{{$indisciplina->id}}">{{$indisciplina->indisciplina}}</option>
              @else
                  <option value="{{$indisciplina->id}}">{{$indisciplina->indisciplina}}</option>
              @endif
            @endforeach
            </optgroup>
          </select>
        </div>

        <div class="form-group">
          <label for="descricao">Descrição dos Fatos</label>
          <textarea name="descricao" rows="3"class="form-control" required="required"></textarea>
        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

        </form>
      </div>
      <!-- /.box-body -->
    </div>
    @endif
    <!-- /.box -->
    <!-- Ultimas ocorrencias -->
    <div class="box box-info box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Ocorrências</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <div class="box-body">
        <table class="table table-bordered  table-striped" id="ocorrencias_table">
          <thead>
            {{-- <tr>
              <th>Data</th>
              <th>Ocorrência</th>
              <th>Alunos</th>
            </tr> --}}
            <tr>
              <th>Data</th>
              <th>created_at</th>
              <th width="40%">Alunos</th>
              <th>Ocorrência</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ocorrencias as $ocorrencia)
              <tr>
                <td>{{ $ocorrencia->created_at }}</td>
                <td>{{ $ocorrencia->created_at }}</td>
                <td>
                  @if(count($ocorrencia->alunos) == 1)
                    <?php

                      $telefones = str_replace('#', ', ', $ocorrencia->alunos[0]->telefone);
                      $estudante[$ocorrencia->id][] = ['nome'=>$ocorrencia->alunos[0]->nome, 'fone' => $telefones ];

                     ?>
                    <a href="{{url('alunos/'.$ocorrencia->alunos[0]->id.'/show')}}">{{ $ocorrencia->alunos[0]->nome}} - {{$ocorrencia->alunos[0]->turma->turma}}</a>
                  @elseif(count($ocorrencia->alunos) > 1)
                    <dl>
                      <dt><i class="fa fa-arrow-down"></i>&nbsp; Vários Alunos</dt>
                    @foreach($ocorrencia->alunos as $aluno)
                      <?php

                        $telefones = str_replace('#', ', ', $aluno->telefone);
                        $estudante[$ocorrencia->id][] = ['nome'=>$aluno->nome, 'fone' => $telefones ];

                       ?>
                      <dd><a href="{{url('alunos/'.$aluno->id.'/show')}}">{{$aluno->nome}} - {{$aluno->turma->turma}}</a></dd>
                    @endforeach
                    </dl>
                  @endif
                </td>
                <td style="vertical-align: middle" class="{{ $ocorrencia->tipo == 'Suspensão' ? 'text-danger' : 'text-warning' }}">{{ $ocorrencia->tipo }}</td>
                <td>
                  <modal
                    v-if="showModal"
                    @close="showModal = false"
                    titulo="{{$ocorrencia->tipo}}"
                    identifica="meOcorre{{$ocorrencia->id}}"
                    descricao="{{$ocorrencia->descricao}}"

                    :estudantes=' <?php echo json_encode($estudante[$ocorrencia->id]); ?>'
                  ></modal>
                  <a href="{{url('ocorrencias/'.$ocorrencia->id.'/print')}}" target="_blank" class="btn btn-xs btn-primary">  <i class="fa fa-print"></i> | Imprimir</a>
                  @if(Auth::user()->hasPermission('update.disciplinar'))
                      &nbsp;<a href="{{url('ocorrencias/'.$ocorrencia->id.'/edit')}}" class="btn btn-xs btn-danger"> <i class="fa fa-edit"> | Editar</i></a>
                  @endif
                  <button @click="showModal = true" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#meOcorre{{$ocorrencia->id}}">
                  <i class="fa fa-eye"></i> | Exibir
                  </button>
                </td>
              </tr>
              {{-- <tr>
                <td class="text-center" style="vertical-align: middle">
                  {{ Carbon::parse($ocorrencia->created_at)->format('d/m/Y') }}
                </td>
                <td style="vertical-align: middle" class="{{ $ocorrencia->tipo == 'Suspensão' ? 'text-danger' : 'text-warning' }}">{{ $ocorrencia->tipo }}</td>
                <td>
                  <select class="form-control">
                    @foreach($ocorrencia->alunos as $aluno)
                      <option>{{ $aluno->nome }} - {{ $aluno->turma->turma}}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <div class="box-tools pull-right">
                    <a href="{{url('ocorrencias/'.$ocorrencia->id.'/print')}}" target="_blank">  <i class="fa fa-print"></i></a>



                  </div>
                  <dl class="dl-horizontal">
                    <dt>Membro da Equipe</dt>
                    <dd>{{$ocorrencia->equipe->funcao}} - {{$ocorrencia->equipe->user->name}}</dd>
                    <dt>Professor</dt>
                    <dd>{{$ocorrencia->professor->professor}}</dd>
                    <dt>Descrição</dt>
                    <dd>{{ $ocorrencia->descricao}}</dd>
                  </dl>
                </td>
              </tr> --}}
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- /Ultimas ocorrencias -->
    <!-- Estatistica Diária -->
    {{-- <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfico de Ocorrências</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <canvas id="grafico_diario" width="400" height="200"></canvas>
        </div>
        <!-- /.box-body -->
      </div> --}}
      <!-- /.box -->
    <!-- /Estatistica Diária -->
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

              @if(Auth::check() && Auth::user()->hasPermission('create.disciplinar'))
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

          <!-- Info Boxes Matutino -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-pie-graph"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Matutino</span>
              <span class="info-box-number">{{$dados['Matutino']['qnt']}} ocorrências</span>

              <div class="progress">
                <div class="progress-bar" style="width: {{ $dados['Matutino']['porcento'] }}%"></div>
              </div>
                  <span class="progress-description">
                    {{ $dados['Matutino']['porcento'] }}% das ocorrências
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

          <!-- Info Boxes Vespertino -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-pie-graph"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Vespertino</span>
              <span class="info-box-number">{{$dados['Vespertino']['qnt']}} ocorrências</span>

              <div class="progress">
                <div class="progress-bar" style="width: {{ $dados['Vespertino']['porcento'] }}%"></div>
              </div>
                  <span class="progress-description">
                    {{ $dados['Vespertino']['porcento'] }}% das ocorrẽncias
                  </span>
            </div>
            <!-- /.info-box-content -->

          </div>

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
  <!-- Moment Js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/pt-br.js"></script>
  <!-- DataTables -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <!-- Charts Js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <!-- Vuejs -->
  <script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>
  <!-- Page script -->
  <script>

    $(function () {
      //Initialize Select2 Elements

      $("#aluno_select").select2({
        ajax: {
          url: "{{url('alunos/apiSelectAluno')}}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
              //page: params.page
            };
          },
          processResults: function (data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
          //  params.page = params.page || 1;

            return {
              results: data.items,

            };
          },
          cache: true
        },
        // escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        // minimumInputLength: 1,
        // templateResult: formatRepo, // omitted for brevity, see the source of this page
        // templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
      });

      $("#professor_select").select2({
        placeholder: "Selecione um Professor",
        allowClear: true
      });

      $("#equipe_select").select2({
        placeholder: "Selecione um Membro da Direção",
        allowClear: true
      });

      $("#indisciplina_select").select2({
        placeholder: "Selecione um Membro da Direção",
        allowClear: true
      });

       $("#ocorrencias_table").DataTable({
         "language": {
             "url": "{{asset('plugins/datatables/lang/portugues.brazil.lang')}}"
         },
        "columnDefs": [
              {
                  // The `data` parameter refers to the data for the cell (defined by the
                  // `data` option, which defaults to the column being worked with, in
                  // this case `data: 0`.
                  "render": function ( data, type, row ) {
                      return moment(data).format('DD/MM/YYYY') ;
                  },
                  "targets": 0,
              },
              {
                "targets": 1, "visible":false
              }
        ],
        "order": [[1, 'desc']]
       });

      // Collapse DT
      $('dt').click(function(e){
          $(this).nextUntil('dt').toggle();
      });

      $('dd').hide();

      // //Modal
      // $(".myModal").modal();



    });

  var ctx = $("#grafico_diario");
  var data = {
      labels: <?php echo json_encode( $dados['chartOcorrencia']['data']) ?>,
      datasets: [
          {
              label: "Ocorrências",
              fill: true,
              lineTension: 0.1,
              backgroundColor: "rgba(75,192,192,0.4)",
              borderColor: "rgba(75,192,192,1)",
              borderCapStyle: 'butt',
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "rgba(75,192,192,1)",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 4,
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(75,192,192,1)",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointHoverBorderWidth: 2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: {{ json_encode( $dados['chartOcorrencia']['total'])}},
              spanGaps: false,
          }
      ]
  };
  var myLineChart = new Chart(ctx, {
      type: 'line',
      data: data,
      options: {
          scales: {
              yAxes: [{
                  ticks:{
                    beginAtZero: true,
                    max: 10,
                  }
              }],
              xAxes: [{
                  display: true,
                  type: 'time',
                  time: {
                      unit: 'day',
                      displayFormats: {
                         day: 'DD/MM'
                      },
                      tooltipFormat: 'LL'
                  }
              }]
          },
          title:{
            display: true,
            text: 'Gráfico de Ocorrências Diárias'
          },
          legend:{
            labels:{

              usePointStyle: true
            }
          },
          layout:{
            padding: 10
          }

      },
  });

  Vue.component('modal', {
    // props:['titulo','identifica', 'descricao', 'estudantes'],
    props:{
      titulo: [String, Number],
      identifica: [String, Number],
      descricao: [String, Number],
      estudantes: {
        type: Array
      }
    },
    template: `
    <div class="modal fade" :id="identifica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@{{titulo}}</h4>
          </div>
          <div class="modal-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Aluno</th>
                  <th>Telefone</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="estudante in estudantes">
                  <td>@{{estudante.nome}}</td>
                  <td>@{{ estudante.fone }}</td>
                </tr>
              </tbody>
            </table>
            <p>@{{descricao}}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')">Fechar</button>
          </div>
        </div>
      </div>
    </div>
    `,

  });

  new Vue({
    el:'#vueModal',

    data: {
      showModal: false
    }

  });

  </script>
@endsection
