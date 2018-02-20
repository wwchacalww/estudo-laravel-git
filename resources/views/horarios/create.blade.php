@section('css')
  @extends('layouts.dashboard')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Google -->
  <link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <style media="screen">
  .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
      border-top: 1px solid #EFD8D8;
      text-align: center;
  }
  </style>
@endsection
@section('breadcrumb')
  <h1>
    Horário
    <small>Novo Horário</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('empregados.index') }}"><i class="fa fa-clock-o"></i> Horário</a></li>
    <li class="active">Novo Horário</li>
  </ol>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12" id="app">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Horário Matutino</h3>
      </div>
      <!-- /.box-header -->

      <!-- form start -->
        <div class="box-body">

          <div class="panel panel-default">
            <div class="panel-body">
              <form class="form-inline" @submit.prevent="onSubmit">
                <div class="form-group">
                  <label for="turma_id">Turma</label>
                  <select class="form-control" name="turma_id" id="turma_id" @change="turma" v-model="turma_id">
                    <option></option>
                    @foreach($turmas as $turma)
                      @if($turma->turno == 'Vespertino')
                        <option value="{{$turma->id}}">{{$turma->turma}}</option>
                      @endif
                    @endforeach
                  </select>
                  <span class="help text-danger" v-if="errors.has('turma_id')" v-text="errors.get('turma_id')"></span>
                </div>

                <div class="form-group">
                  <label for="horario">Horario</label>
                  <select class="form-control" name="horario" id="horario" v-model="horario" @change="errors.clear('horario')">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>

                  </select>

                  <span class="help text-danger" v-if="errors.has('horario')" v-text="errors.get('horario')"></span>
                </div>

                <div class="form-group">
                  <label for="horario">Dia</label>
                  <select class="form-control" name="dia" id="dia" v-model="dia" @change="errors.clear('dia')">
                    <option value="Segunda">Segunda</option>
                    <option value="Terça">Terça</option>
                    <option value="Quarta">Quarta</option>
                    <option value="Quinta">Quinta</option>
                    <option value="Sexta">Sexta</option>

                  </select>

                  <span class="help text-danger" v-if="errors.has('dia')" v-text="errors.get('dia')"></span>
                </div>

                <div class="form-group">
                  <label for="disciplina_id">Disciplina</label>
                  <select class="form-control" name="disciplina_id" id="disciplina_id" v-model="disciplina_id" @change="errors.clear('disciplina_id')">
                    <option value=""></option>
                    <option v-for="disciplina in disciplinas" :value="disciplina.id">@{{disciplina.disciplina}}</option>
                  </select>
                  <span class="help text-danger" v-if="errors.has('disciplina_id')" v-text="errors.get('disciplina_id')"></span>
                </div>

                <button type="submit" class="btn btn-default" :disabled="errors.any()">Salvar</button>
              </form>
            </div>
          </div>
<!--
          <table class="table table-responsive table-hover">
            <thead>
              <tr style="border: 1px solid #000;">
                <th colspan="2" style="border-bottom: 1px solid #000;"></th>
                @foreach($turmas as $turma)
                  @if($turma->turno == 'Matutino')
                    <th style="border-bottom: 1px solid #000;">{{ str_replace("º ", "", substr($turma->turma, 0, 5))}}</th>
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
                      if($i ==2 ){ $dia = array('S','E','G','U','N','D','A'); }
                      if($i ==3 ){ $dia = array('T','E','R','Ç','A'); }
                      if($i ==4 ){ $dia = array('Q','U','A','R','T','A'); }
                      if($i ==5 ){ $dia = array('Q','U','I','N','T','A'); }
                      if($i ==6 ){ $dia = array('S','E','X','T','A'); }
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
                            <td><b :style="{color: <?php echo "matutinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['cor']"; ?>}">
                            <?php echo "{{ matutinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['disciplina']}}"; ?></b>
                          </td>
                        @endif
                      @endforeach
                    </tr>
                  @else
                    <tr>
                      <td <?php echo $j == 6 ? ' style="border-bottom: 1px solid #000;" ' : '';?> >

                        {{$j}}º
                      </td>
                      @foreach($turmas as $turma)
                        @if($turma->turno == 'Matutino')
                          <td <?php echo $j == 6 ? ' style="border-bottom: 1px solid #000;" ' : '';?> ><b :style="{color: <?php echo "matutinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['cor']"; ?>}">
                            <?php echo "{{ matutinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['disciplina']}}"; ?></b>
                          </td>
                        @endif
                      @endforeach
                    </tr>
                  @endif
                @endfor
              @endfor


            </tbody>
          </table>

-->

        </div>
        <!-- /.box-body -->
    </div>


    <!-- HOrario Vespertino -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Horário Vespertino <button type="button" name="button" @click="vespertino"><i class="fa fa-refresh"></i></button></h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
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
                      if($i ==2 ){ $dia = array('S','E','G','U','N','D','A'); }
                      if($i ==3 ){ $dia = array('T','E','R','Ç','A'); }
                      if($i ==4 ){ $dia = array('Q','U','A','R','T','A'); }
                      if($i ==5 ){ $dia = array('Q','U','I','N','T','A'); }
                      if($i ==6 ){ $dia = array('S','E','X','T','A'); }
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
                            <td><b :style="{color: <?php echo "vespertinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['cor']"; ?>}">
                            <?php echo "{{ vespertinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['disciplina']}}"; ?></b>
                          </td>
                        @endif
                      @endforeach
                    </tr>
                  @else
                    <tr>
                      <td <?php echo $j == 6 ? ' style="border-bottom: 1px solid #000;" ' : '';?> >

                        {{$j}}º
                      </td>
                      @foreach($turmas as $turma)
                        @if($turma->turno == 'Vespertino')
                          <td <?php echo $j == 6 ? ' style="border-bottom: 1px solid #000;" ' : '';?> ><b :style="{color: <?php echo "vespertinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['cor']"; ?>}">
                            <?php echo "{{ vespertinos[$i][$j]['".str_replace("º ", "", substr($turma->turma, 0, 5))."']['disciplina']}}"; ?></b>
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
        <!-- /.box-body -->
    </div>

    <!-- /HOrario Vespertino -->
  </div>
</div>
@endsection
@section('jsScripts')
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('js/locales/datepicker-pt-BR.js')}}"></script>
  <!-- InputMask -->
  <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <!-- VueJs -->
  <script src="https://unpkg.com/vue"></script>
  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  {{-- <!-- Horario Js -->
  <script src="{{asset('js/horario.js')}}"></script> --}}
  <script>

  $(function(){
    //Date picker

  $('#data_admissao').datepicker({
      language: 'pt-BR',
      autoclose: true
    });
  });

  $('#cpf_mask').inputmask("999.999.999-99");
  $('#data_admissao').inputmask("99/99/9999");
  // Construindo um classe para errors
  class Errors {
    constructor() {
      this.errors = {};
    }

    has(field){
      return this.errors.hasOwnProperty(field);
    }

    any(){
      return Object.keys(this.errors).length > 0;
    }

    get(field){
      if(this.errors[field]){
        return this.errors[field][0];
      }
    }

    record(errors){
      this.errors = errors;
    }

    clear(field){
      delete this.errors[field];
    }
  }

  new Vue ({
    el: '#app',

    data:{
      turma_id: '',
      horario: '',
      disciplina_id: '',
      dia:'',
      disciplinas: [],
      matutinos:[],
      vespertinos:[],
      errors: new Errors()

    },

    mounted(){
      this.matutino();
      this.vespertino();
    },

    methods:{
      turma: function(event){
        axios.get( '{{ url('horarios/turma_disciplinas') }}' ,{
          params:{
            q: this.turma_id
          }
        }).then(response => this.disciplinas = response.data);

        this.errors.clear('turma_id');
      },

      matutino: function(){
        axios.get( '{{ url('horarios/api_horario') }}' ,{
          params:{
            turno: 'Matutino'
          }
        }).then(response => this.matutinos = response.data);
      },

      vespertino: function(){
        axios.get( '{{ url('horarios/api_horario') }}' ,{
          params:{
            turno: 'Vespertino'
          }
        }).then(response => this.vespertinos = response.data);
      },

      onSubmit: function(){
        axios.post('{{url('horarios/store')}}', this.$data)
          .then(this.onSuccess)
          .catch(error => this.errors.record(error.response.data));
      },

      onSuccess(response){
        this.turma_id= '';
        // this.horario= '';
        this.disciplina_id= '';
        // this.dia= '';
        this.disciplinas= [];
        this.matutino();
        this.vespertino();
      }

    }
  });
  </script>

@endsection
