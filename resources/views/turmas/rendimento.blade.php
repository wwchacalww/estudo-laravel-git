@extends('layouts.dashboard')
@section('css')
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
@endsection
@section('breadcrumb')
  <h1>
    Direção
    <small>Carômetro {{ $turma->turma }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Direção</a></li>
    <li><a href="{{ route('turmas.index') }}"><i class="fa fa-list-ul"></i> Turmas</a></li>
    <li class="active">Carômetro</li>
  </ol>
@endsection
@section('content')
<div class="row">

  <section class="col-lg-12 connectedSortable">
    <!-- USERS LIST -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $turma->turma }}</h3>

          <div class="box-tools pull-right">
            <span class="label label-info">{{ count($turma->alunos )}} Alunos</span>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          @foreach( $turma->alunos->sortby('nome') as $aluno)
          <div class="row">
            <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue">
                  <div class="widget-user-image">
                    @if(File::exists(public_path().'/fotos/'.$aluno->matricula.'.jpg'))
                      <img class="img-circle" src="{{asset('fotos/'.$aluno->matricula.'.jpg')}}" alt="{{$aluno->nome}}">
                    @else
                      <img class="img-circle" src="{{asset('img/semfoto.jpg')}}" alt="{{$aluno->nome}}">
                    @endif
                  </div>
                  <!-- /.widget-user-image -->
                  <a href="{{url('alunos/'.$aluno->id.'/show')}}" style="color:#FFF"><h3 class="widget-user-username">  {{$aluno->nome}}</h3></a>
                  <!-- <h5 class="widget-user-desc">{{$aluno->turma->turma}}</h5> -->
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
                        <th width="10%">Ciências</th>
                        <th width="10%">Educação Física</th>
                        <th width="10%">Geografia</th>
                        <th width="10%">História</th>
                        <th width="10%">Inglês</th>
                        <th width="10%">Matemática</th>
                        <th width="10%">Português</th>
                        <th width="10%">PDI</th>
                        <th width="10%">PDII</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $notas['Artes']; ?></td>
                        <td><?php echo $notas['Ciências Naturais']; ?></td>
                        <td><?php echo $notas['Educação Física']; ?></td>
                        <td><?php echo $notas['Geografia']; ?></td>
                        <td><?php echo $notas['História']; ?></td>
                        <td><?php echo $notas['Inglês']; ?></td>
                        <td><?php echo $notas['Matemática']; ?></td>
                        <td><?php echo $notas['Português']; ?></td>
                        <td><?php echo $notas['Práticas Diversificadas I']; ?></td>
                        <td><?php echo $notas['Práticas Diversificadas II']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- /.box-body -->
              </div>
          </div>
          @endforeach
        </div>
      </div>
      <!-- /.users-list -->
  </section>

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
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
