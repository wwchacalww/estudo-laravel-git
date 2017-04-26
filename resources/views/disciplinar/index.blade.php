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
    @if(Auth::check() && Auth::user()->hasPermission('create.disciplinar'))

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
              <option value="{{$equipe->id}}">{{$equipe->funcao}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="professor">Medida Disciplinar</label>
          <select class="form-control" name="tipo" required="required" >
              <option>Advertência Oral</option>
              <option>Advertência Escrita</option>
              <option>Supensão</option>
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
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
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

    });



  </script>
@endsection
