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
    <small>Lançamento de Notas e Faltas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('rendimentos.index') }}"><i class="fa fa-line-chart"></i> Renmento Escolar</a></li>
    <li class="active">Notas e Faltas</li>
  </ol>
@endsection
@section('content')
<div class="row" id="app">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Lançamento de Notas e Faltas</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      {!! Form::open(['route'=>'rendimentos.store', 'method'=>'post', 'files' => true]) !!}
        <div class="box-body">
          <div class="form-group">
            <label for="turma">Turma</label>
            <select class="form-control" required name="turma_id" id="turma_id" @change="turma" v-model="turma_id">
              <option value=""></option>
              @foreach($turmas as $turma)
                <option value="{{$turma->id}}">{{$turma->turma}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="disciplinas">Disciplinas</label>
            <select class="form-control select2" multiple="multiple" required name="disciplinas[]" v-model="disciplina_id" id="disciplina_id">
              <option value=""></option>
              <option v-for="materia in materias" :value="materia.disciplina+'_'+materia.id">@{{materia.disciplina}}</option>
            </select>
          </div>

          <div class="form-group">
            <label for="bimestre">Bimestre</label>
            <select class="form-control" name="bimestre">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="arquivo">Notas</label>
            <input type="file" class="form-control" required name="notas" >
          </div>

          <div class="form-group">
            <label for="arquivo">Faltas</label>
            <input type="file" class="form-control" required name="faltas" >
          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Lançar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('jsScripts')
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  <!-- VueJs -->
  <script src="https://unpkg.com/vue"></script>
  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!-- Page script -->
  <script>
  $(function(){
    $('#disciplina_id').select2();
  });
  new Vue ({
    el: '#app',

    data:{
      turma_id: '',
      materias:[],
      disciplina_id: []
    },

    methods:{
      turma: function(event){
        axios.get( '{{ url('horarios/turma_disciplinas') }}' ,{
          params:{
            q: this.turma_id
          }
        }).then(response => this.materias = response.data);
      }
    }
  });
  </script>
@endsection
