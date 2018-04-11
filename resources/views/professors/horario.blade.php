@extends('layouts.professor')
@section('content')
      <div class="starter-template">

  @foreach($cargas as $carga)
        <h3>Horário</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Segunda</th>
                <th class="text-center">Terça</th>
                <th class="text-center">Quarta</th>
                <th class="text-center">Quinta</th>
                <th class="text-center">Sexta</th>
              </tr>
            </thead>
            <tbody>

                @for($j = 1; $j <= 6; $j++)
                  <tr>
                    <td>{{ $j }}º</td>
                    <td>{{ $carga[$j]['Segunda'] }}</td>
                    <td>{{ $carga[$j]['Terça'] }}</td>
                    <td>{{ $carga[$j]['Quarta'] }}</td>
                    <td>{{ $carga[$j]['Quinta'] }}</td>
                    <td>{{ $carga[$j]['Sexta'] }}</td>
                  </tr>

                @endfor

            </tbody>
          </table>
@endforeach

      </div>
@endsection
