@php
  // Cho phép truyền biến tuỳ chọn: $alertSuccess, $alertError
@endphp
@if(isset($alertSuccess))
  <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">{{ $alertSuccess }}</div>
@endif
@if(isset($alertError))
  <div class="mb-4 rounded-lg border border-red-200 bg-red-50 text-red-800 px-4 py-3">{{ $alertError }}</div>
@endif