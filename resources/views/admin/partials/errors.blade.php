@if ($errors->any())
  <div class="alert alert-danger">
    <div><strong>Vui lòng kiểm tra lại:</strong></div>
    <ul class="mb-0">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif
