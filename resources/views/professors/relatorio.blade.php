@extends('layouts.professor')
@section('content')
  <div class="starter-template">
    <h1>Relatório</h1>

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading text-left">Turmas <span class="badge pull-right">Total de Alunos</span></div>

      <!-- List group -->
      <div class="list-group text-left">
        @foreach($professor->cargas as $carga)
          @if($carga->created_at > "2018-01-01 00:01:01")
            @foreach($carga->turmas as $turma)
              <a href="{{url('professor/'.$turma->id.'/showturma')}}" class="list-group-item list-group-primary">{{$turma->turma}} <span class="badge">{{count($turma->alunos)}}</span></a>
            @endforeach
          @endif
        @endforeach
      </div>
    </div>
    <h1>Conteúdo Programático</h1>
    @if(count($requisitos) > 0)
      <?php
        $habilidade = "";
        $etapa = "";
        $serie = "";
      ?>
      @foreach($requisitos->sortby('serie') as $requisito)
        @if(in_array($requisito->serie, $series))
          @if($habilidade != $requisito->habilidade)
            <?php $habilidade = $requisito->habilidade; ?>
            <h2 class="text-info">{{ $requisito->habilidade}}</h2>
          @endif

          @if($etapa != $requisito->etapa)
            <?php $etapa = $requisito->etapa; ?>
            <h3 class="text-success">{{ $requisito->etapa}}</h3>
          @endif

          @if($serie != $requisito->serie)
            <?php $serie = $requisito->serie; ?>
          @endif
          <!-- Painel -->
          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">{{ $requisito->serie}}</div>
            <div class="panel-body text-left">
              <dl>
                <dt>Conteúdo</dt>
                <dd>{{$requisito->conteudo}}</dd>
                <dt>Pré-Requisito</dt>
                <dd>{{$requisito->pre_requisito}}</dd>
                <dt>Reagrupamento</dt>
                <dd><span class="label label-default">{{$requisito->reagrupamentos->count()}}</span> Alunos Reagrupados</dd>
                <dd><span class="label label-danger">{{$requisito->reagrupamentos->where('status', 'Inapto')->count()}}</span> Alunos Inaptos</dd>
                <dd><span class="label label-success">{{$requisito->reagrupamentos->where('status', 'Apto')->count()}}</span> Alunos Aptos</dd>
              </dl>
            </div>

            <!-- List group -->
            <div class="list-group">
              @foreach($professor->disciplinas->where('ano', date('Y')) as $disciplina)
                @if($disciplina->habilidade == $habilidade)
                  @foreach($disciplina->turmas as $turma)
                    @if($turma->serie == $requisito->serie)
                      <?php // Deifinindo os grupos de reagrupamento
                      $reagrupados = $requisito->reagrupamentos->filter(function ($value, $key) use ($turma){

                        return $value->aluno->turma_id == $turma->id;
                      });

                      ?>
                      <a href="#" class="list-group-item text-left">
                        {{ $turma->turma}}
                        <span class="label label-danger pull-right">{{$reagrupados->where('status','Inapto')->count()}}</span>
                        <span class="label label-success pull-right">{{$reagrupados->where('status','Apto')->count()}}</span>
                        <span class="label label-default pull-right">{{count($reagrupados->all())}}</span>

                      </a>
                    @endif
                  @endforeach
                @endif
              @endforeach
            </div>
          </div>
          <!-- fim do painel -->

        @endif

      @endforeach
    @endif
  </div>
@endsection
