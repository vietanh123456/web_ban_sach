@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Danh mục')

@section('content')
  {{-- Thông báo & lỗi --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Vui lòng kiểm tra lại:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Chỉnh sửa Danh mục</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">← Quay lại</a>
  </div>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
          <input
            type="text"
            name="name"
            value="{{ old('name', $category->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            required
          >
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Slug (tuỳ chọn)</label>
          <input
            type="text"
            name="slug"
            value="{{ old('slug', $category->slug) }}"
            class="form-control @error('slug') is-invalid @enderror"
            placeholder="vd: lap-trinh, sach-moi..."
          >
          @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <div class="form-text">Để trống nếu muốn hệ thống tự tạo từ tên.</div>
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-success">Cập nhật</button>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
      </form>
    </div>
  </div>
@endsection
