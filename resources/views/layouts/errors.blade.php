@if(count($errors))
  <div class="form-group">
    <div class="callout callout-danger">
        <h4>Atente para os seguintes errors no formulário</h4>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach

      </div>
  </div>
@endif
