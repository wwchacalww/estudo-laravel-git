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
    <small>Horario</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('horarios.cargas.index') }}"><i class="fa fa-clock-o"></i> Horario</a></li>
    <li>Grade Horária</li>
  </ol>
@endsection

@section('content')
<div id="app">
<div class="row">
  <!-- Coluna da Esquerda  -->
  <div class="col-lg-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Horário Matutino</h1>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="box-body">

        <table class="table table-responsive table-hover">

          <thead>
            <tr style="border: 1px solid #000;">
              <th colspan="2" style="border-bottom: 1px solid #000;"></th>
              @foreach($turmas as $turma)
                @if($turma->turno == 'Matutino')
                  <th style="border-bottom: 1px solid #000;">{{ substr($turma->turma, 0, 5)}}</th>
                @endif
              @endforeach
            </tr>
          </thead>

          <tbody>
            @for($i=2; $i < 7 ; $i++)
              @for($j=1; $j <=6  ; $j++)
                @if($j == 1)
                  <tr>
                    <td rowspan="6" style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                    <?php
                    if($i ==2 ){ $dia = array('S','E','G','U','N','D','A'); $diaSemana = 'Segunda'; }
                    if($i ==3 ){ $dia = array('T','E','R','Ç','A'); $diaSemana = 'Terça'; }
                    if($i ==4 ){ $dia = array('Q','U','A','R','T','A'); $diaSemana = 'Quarta'; }
                    if($i ==5 ){ $dia = array('Q','U','I','N','T','A'); $diaSemana = 'Quinta'; }
                    if($i ==6 ){ $dia = array('S','E','X','T','A'); $diaSemana = 'Sexta'; }
                     ?>
                      @for($l=0; $l < count($dia) ; $l++)
                        <h4 class="text-success" style="font-family: 'Baloo', cursive;">{{ $dia[$l] }}</h4>
                      @endfor
                    </td>
                    <td>
                      1º
                    </td>
                    @foreach($turmas as $turma)
                      @if($turma->turno == 'Matutino')
                          <td <?php echo $turma->id == 36 ? 'style="border-right: 1px solid #000;" ' : ''; ?> >
                            <b style="color: {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->cor }}">
                              {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->disciplina }}
                            </b>
                        </td>
                      @endif
                    @endforeach
                  </tr>
                @else
                  <tr>
                    <td <?php
                      echo $j == 6 ? ' style="border-bottom: 1px solid #000;" ' : '';?> >

                      {{$j}}º
                    </td>
                    @foreach($turmas as $turma)
                      @if($turma->turno == 'Matutino')
                        <td <?php
                          if($j == 6 && $turma->id == 36){
                            echo ' style="border-bottom: 1px solid #000; border-right: 1px solid #000;" ';
                          }elseif($j == 6 && $turma->id != 36){
                            echo ' style="border-bottom: 1px solid #000;" ';
                          }elseif($j != 6 && $turma->id == 36){
                            echo ' style="border-right: 1px solid #000;" ';
                          }
                          ?> >
                          <b style="color: {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->cor }}">
                            {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->disciplina }}
                          </b>
                        </td>
                      @endif
                    @endforeach
                  </tr>
                @endif
              @endfor
            @endfor


          </tbody>
        </table>

      </div>
    </div>
  </div>
  <!-- /Coluna da Esquerda -->
  <!-- Coluna da Direita -->
  <div class="col-lg-3">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Professores Matutino</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="box-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Professores</th>
              <th>Disciplinas</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cargas as $carga)
              @if($carga->turmas->first()->turno == 'Matutino')
                <tr>
                  <td>
                    <modal_professor v-if="showModal{{$carga->id}}" meu_horario="carga{{$carga->id}}" professor_id="{{$carga->id}}"></modal_professor>
                    <button type="button" @click="showModal{{$carga->id}} = true" class="btn btn-link btn-lg" data-toggle="modal" data-target="#carga{{$carga->id}}">
                    <i class="fa fa-eye"></i> | {{$carga->professor->professor}}
                    </button>

                  </td>
                  <td>
                    @foreach($carga->disciplinas as $disciplina)
                      <b style="color: {{$disciplina->cor}}">{{$disciplina->disciplina}} &nbsp;</b>
                    @endforeach
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>
  <!-- /Coluna da Direita -->

</div>

<!-- HOrario Vespertino -->
<div class="row">
  <!-- Coluna da Esquerda  Ocorrencias -->
  <div class="col-lg-9">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Horário Vespertino</h1>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="box-body">

        <table class="table table-responsive table-hover">

          <thead>
            <tr style="border: 1px solid #000;">
              <th colspan="2" style="border-bottom: 1px solid #000;"></th>
              @foreach($turmas as $turma)
                @if($turma->turno == 'Vespertino')
                  <th style="border-bottom: 1px solid #000;">{{ substr($turma->turma, 0, 5)}}</th>
                @endif
              @endforeach
            </tr>
          </thead>

          <tbody>
            @for($i=2; $i < 7 ; $i++)
              @for($j=1; $j <=6  ; $j++)
                @if($j == 1)
                  <tr>
                    <td rowspan="6" style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                    <?php
                    if($i ==2 ){ $dia = array('S','E','G','U','N','D','A'); $diaSemana = 'Segunda'; }
                    if($i ==3 ){ $dia = array('T','E','R','Ç','A'); $diaSemana = 'Terça'; }
                    if($i ==4 ){ $dia = array('Q','U','A','R','T','A'); $diaSemana = 'Quarta'; }
                    if($i ==5 ){ $dia = array('Q','U','I','N','T','A'); $diaSemana = 'Quinta'; }
                    if($i ==6 ){ $dia = array('S','E','X','T','A'); $diaSemana = 'Sexta'; }
                     ?>
                      @for($l=0; $l < count($dia) ; $l++)
                        <h4 class="text-success" style="font-family: 'Baloo', cursive;">{{ $dia[$l] }}</h4>
                      @endfor
                    </td>
                    <td>
                      1º
                    </td>
                    @foreach($turmas as $turma)
                      @if($turma->turno == 'Vespertino')
                          <td <?php echo $turma->id == 23 ? 'style="border-right: 1px solid #000;" ' : ''; ?> >
                            <b style="color: {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->cor }}">
                              {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->disciplina }}
                            </b>
                        </td>
                      @endif
                    @endforeach
                  </tr>
                @else
                  <tr>
                    <td <?php
                      echo $j == 6 ? ' style="border-bottom: 1px solid #000;" ' : '';?> >

                      {{$j}}º
                    </td>
                    @foreach($turmas as $turma)
                      @if($turma->turno == 'Vespertino')
                        <td <?php
                          if($j == 6 && $turma->id == 23){
                            echo ' style="border-bottom: 1px solid #000; border-right: 1px solid #000;" ';
                          }elseif($j == 6 && $turma->id != 23){
                            echo ' style="border-bottom: 1px solid #000;" ';
                          }elseif($j != 6 && $turma->id == 23){
                            echo ' style="border-right: 1px solid #000;" ';
                          }
                          ?> >
                          <b style="color: {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->cor }}">
                            {{ $turma->horarios->where('dia' , $diaSemana)->where('horario', $j)->first()->disciplina->disciplina }}
                          </b>
                        </td>
                      @endif
                    @endforeach
                  </tr>
                @endif
              @endfor
            @endfor


          </tbody>
        </table>

      </div>
    </div>
  </div>
  <!-- /Coluna da Esquerda -->
  <!-- Coluna da Direita -->
  <div class="col-lg-3">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Professores Vespertino</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>

      <div class="box-body">


        <table class="table table-hover">
          <thead>
            <tr>
              <th>Professores</th>
              <th>Disciplinas</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cargas as $carga)
              @if($carga->turmas->first()->turno == 'Vespertino')
                <tr>
                  <td>
                    <modal_professor v-if="showModal{{$carga->id}}" meu_horario="carga{{$carga->id}}" professor_id="{{$carga->id}}"></modal_professor>
                    <button type="button" @click="showModal{{$carga->id}} = true" class="btn btn-link btn-lg" data-toggle="modal" data-target="#carga{{$carga->id}}">
                    <i class="fa fa-eye"></i> | {{$carga->professor->professor}}
                    </button>

                  </td>
                  <td>
                    @foreach($carga->disciplinas as $disciplina)
                      <b style="color: {{$disciplina->cor}}">{{$disciplina->disciplina}} &nbsp;</b>
                    @endforeach
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>
  <!-- /Coluna da Direita -->

</div>
<!-- /Horario Vespertino -->
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
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!-- Vuejs -->
  <script src="https://unpkg.com/vue@2.1.3/dist/vue.js"></script>
  <!-- Page Script -->

  <script>
  Vue.component('modal_professor', {
    props: ['professor_id', 'meu_horario'],
    template: `
    <div class="modal fade" :id="meu_horario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@{{horario.professor}}</h4>
          </div>
          <div class="modal-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Segunda</th>
                  <th>Terça</th>
                  <th>Quarta</th>
                  <th>Quinta</th>
                  <th>Sexta</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1º</td>
                  <td v-for="disc in horario.Primeiro">@{{disc}}</td>
                </tr>
                <tr>
                  <td>2º</td>
                  <td v-for="disc in horario.Segundo">@{{disc}}</td>
                </tr>
                <tr>
                  <td>3º</td>
                  <td v-for="disc in horario.Terceiro">@{{disc}}</td>
                </tr>
                <tr>
                  <td>4º</td>
                  <td v-for="disc in horario.Quarto">@{{disc}}</td>
                </tr>
                <tr>
                  <td>5º</td>
                  <td v-for="disc in horario.Quinto">@{{disc}}</td>
                </tr>
                <tr>
                  <td>6º</td>
                  <td v-for="disc in horario.Sexto">@{{disc}}</td>
                </tr>
              </tbody>
            </table>
            <p></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')">Fechar</button>
          </div>
        </div>
      </div>
    </div>
    `,

    data(){
      return { horario: [] }
    },

    mounted(){
      axios.get( '{{ url('horarios/api_professor_horario') }}' ,{
        params:{
          q: this.professor_id
        }
      }).then(response => this.horario = response.data);
    }
  });

  new Vue({
    el:'#app',

    data:{
      @foreach($cargas as $carga)
        {{ 'showModal'.$carga->id.': false , '}}
      @endforeach
    }


  });

  </script>


@endsection
