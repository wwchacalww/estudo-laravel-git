@extends('layouts.professor')
@section('content')
  <div class="starter-template">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Lista de Turmas</div>

      <!-- List group -->
      <div class="list-group">
        @foreach($professor->cargas as $carga)

          @if($carga->created_at > "2018-01-01 00:01:01")
            @foreach($carga->turmas as $turma)
              <a href="{{url('professor/'.$turma->id.'/showturma')}}" class="list-group-item list-group-primary">{{$turma->turma}}</a>
            @endforeach
          @endif


        @endforeach
      </div>
    </div>
  </div>
@endsection
