@extends('layouts.professor')
@section('content')
  <div class="starter-template">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">{{$turma->turma}}</div>

      <!-- List group -->
      <div class="list-group text-left">
        @foreach($turma->alunos->sortBy('nome') as $aluno)
          <a href="#" class="list-group-item list-group-primary">{{$aluno->nome}}</a>
        @endforeach
      </div>
    </div>
  </div>
@endsection
