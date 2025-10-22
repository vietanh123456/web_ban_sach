@php
  // Ưu tiên biến truyền trực tiếp; nếu không có thì dùng flash trong session
  $success = $alertSuccess ?? session('success');
  $error   = $alertError   ?? session('error');
@endphp

@if($success)
  <div role="alert" class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">
    {{ $success }}
  </div>
@endif

@if($error)
  <div role="alert" class="mb-4 rounded-lg border border-red-200 bg-red-50 text-red-800 px-4 py-3">
    {{ $error }}
  </div>
@endif

@push('scripts')
<script>
  // Ẩn alert sau 2.5s cho gọn UI
  setTimeout(() => {
    document.querySelectorAll('[role="alert"]').forEach(el => el.style.display = 'none');
  }, 2500);
</script>
@endpush
