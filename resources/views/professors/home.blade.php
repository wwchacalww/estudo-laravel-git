@extends('layouts.professor')
@section('content')
      <div class="starter-template">
        <h1>Conteúdo Programático</h1>
        @if(count($requisitos) > 0)
          <?php
            $habilidade = "";
            $etapa = "";
            $serie = "";
          ?>
          @foreach($requisitos as $requisito)
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
              <h4 class="text-danger">{{ $requisito->serie}}</h4>
            @endif

            <dl>
              <dt>Conteúdo</dt>
              <dd>{{$requisito->conteudo}}</dd>
              <dt>Pré-requisito</dt>
              <dd>{{$requisito->pre_requisito}}</dd>
              <dt>Turmas</dt>
              @foreach($professor->disciplinas->where('ano', date('Y')) as $disciplina)
                @if($disciplina->habilidade == $habilidade)
                  @foreach($disciplina->turmas as $turma)
                    <dd><a href="{{ action('ReagrupamentosController@turma', ['turma' => $turma->id, 'disciplina' => $disciplina->id, 'requisito' => $requisito->id])}}" class="btn btn-primary">{{ $turma->turma}}</a></dd><dd>---</dd>
                  @endforeach
                @endif
              @endforeach
            </dl>
          @endforeach
        @endif

      </div>
@endsection
