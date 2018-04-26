@extends('layouts.professor')
@section('content')
  <div class="starter-template">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">{{$turma->turma}}</div>
      <div class="panel-body text-left">
        <dl>
          <dt>Conteúdo</dt>
          <dd>{{$requisito->conteudo}}</dd>
          <dt>Pré-Requisito</dt>
          <dd>{{$requisito->pre_requisito}}</dd>
        </dl>

        <h4><span class="label label-success">VERDE APTO</span> <span class="label label-danger">VERMELHO INAPTO</span></h4>
      </div>

      <!-- List group -->
      <div class="list-group">
        @foreach($turma->alunos->sortBy('nome') as $aluno)
          <?php
          $status = $aluno->reagrupamentos->where('disciplina_id', $disciplina->id)->where('requisito_id', $requisito->id)->first();

          ?>
          <a href="{{url('professor/'.$status->id.'/reagrupar')}}" class="list-group-item {{ ($status->status == 'Apto' ? 'list-group-item-success' : 'list-group-item-danger') }} text-left">{{$aluno->nome}}</a>
        @endforeach
      </div>
    </div>
  </div>
@endsection
