@extends('admin.layouts.app')

@section('title', 'Thêm Danh mục')

@section('content')
  {{-- Hiện lỗi validate --}}
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

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Thêm Danh mục</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">← Quay lại</a>
  </div>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
          <input type="text"
                 name="name"
                 value="{{ old('name') }}"
                 class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Slug (tuỳ chọn)</label>
          <input type="text"
                 name="slug"
                 value="{{ old('slug') }}"
                 class="form-control"
                 placeholder="vd: lap-trinh, sach-moi...">
          <div class="form-text">
            Để trống nếu muốn hệ thống tự tạo từ tên.
          </div>
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-success">Lưu</button>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
      </form>
    </div>
  </div>
@endsection
