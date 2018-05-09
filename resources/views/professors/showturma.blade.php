@extends('layouts.professor')
@section('content')
  <div class="starter-template">

    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">{{$turma->turma}}</div>
      @foreach($turma->alunos->sortBy('nome') as $aluno)
      <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-green">
          <div class="widget-user-image">
            @if( File::exists( public_path().'/fotos/'.$aluno->matricula.'.jpg'))
              <img class="img-circle" src="{{asset('fotos/'.$aluno->matricula.'.jpg')}}" alt="{{$aluno->nome}}">
            @else
              <img class="img-circle" src="{{asset('img/semfoto.jpg')}}" alt="{{$aluno->nome}}">
            @endif
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username text-left">{{$aluno->nome}}</h3>
          <h5 class="widget-user-desc text-left">{{ Carbon::parse($aluno->dn)->age}} anos de idade</h5>
        </div>
      </div>
      @endforeach

      <!-- List group -->
      
    </div>
  </div>
@endsection
