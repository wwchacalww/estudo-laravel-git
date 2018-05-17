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
          <table class="table">
            <thead>
              <tr>
                <?php
                  $notas['Artes'] = '-';
                  $notas['Ciências Naturais'] = '-';
                  $notas['Educação Física'] = '-';
                  $notas['Geografia'] = '-';
                  $notas['História'] = '-';
                  $notas['Inglês'] = '-';
                  $notas['Matemática'] = '-';
                  $notas['Português'] = '-';
                  $notas['Práticas Diversificadas I'] = '-';
                  $notas['Práticas Diversificadas II'] = '-';
                  if( $aluno->rendimentos->where('bimestre', 1)->where('created_at', '>', '2018-01-01 00:01:01')->count() > 0 ){
                    foreach($aluno->rendimentos->where('bimestre', 1)->where('created_at', '>', '2018-01-01 00:01:01') as $nota ){
                      if($nota->nota < 5 ){
                        $notas[$nota->disciplina->habilidade] = '<span data-toggle="tooltip" title="Nota" class="badge bg-red">'.
                          $nota->nota.'</span> <span data-toggle="tooltip" title="Faltas" class="badge bg-black">'.$nota->faltas.'</span>';
                      }
                      if($nota->nota >= 5 ){
                        $notas[$nota->disciplina->habilidade] = '<span data-toggle="tooltip" title="Nota" class="badge bg-yellow">'.
                          $nota->nota.'</span> <span data-toggle="tooltip" title="Faltas" class="badge bg-black">'.$nota->faltas.'</span>';
                      }
                      if($nota->nota > 7 ){
                        $notas[$nota->disciplina->habilidade] = '<span data-toggle="tooltip" title="Nota" class="badge bg-light-blue">'.
                          $nota->nota.'</span> <span data-toggle="tooltip" title="Faltas" class="badge bg-black">'.$nota->faltas.'</span>';
                      }
                    }
                  }

                ?>
                <th width="10%">Arte</th>
                <th width="10%">CN</th>
                <th width="10%">EDF</th>
                <th width="10%">GEO</th>
                <th width="10%">HIST</th>
                <th width="10%">LEM</th>
                <th width="10%">MAT</th>
                <th width="10%">PORT</th>
                <th width="10%">PDI</th>
                <th width="10%">PDII</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td align="left"><?php echo $notas['Artes']; ?></td>
                <td align="left"><?php echo $notas['Ciências Naturais']; ?></td>
                <td align="left"><?php echo $notas['Educação Física']; ?></td>
                <td align="left"><?php echo $notas['Geografia']; ?></td>
                <td align="left"><?php echo $notas['História']; ?></td>
                <td align="left"><?php echo $notas['Inglês']; ?></td>
                <td align="left"><?php echo $notas['Matemática']; ?></td>
                <td align="left"><?php echo $notas['Português']; ?></td>
                <td align="left"><?php echo $notas['Práticas Diversificadas I']; ?></td>
                <td align="left"><?php echo $notas['Práticas Diversificadas II']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      @endforeach

      <!-- List group -->

    </div>
  </div>
@endsection
