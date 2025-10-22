@extends('admin.layouts.app')

@section('title','Thêm sách')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-3">Thêm sách mới</h5>

    {{-- Lỗi tổng quát --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input type="text" name="author" value="{{ old('author') }}" class="form-control">
        @error('author') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Giá (đ) <span class="text-danger">*</span></label>
        <input type="number" name="price" value="{{ old('price') }}" class="form-control" min="0" step="1" required>
        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Danh mục</label>
        <select name="category_id" class="form-select">
          <option value="">-- Không chọn --</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      {{-- Cách 1: Dán link ảnh --}}
      <div class="mb-3">
        <label class="form-label">Ảnh (URL)</label>
        <input type="url" name="image_url" value="{{ old('image_url') }}" class="form-control" placeholder="https://...">
        <div class="form-text">Dán link ảnh nếu có. Nếu upload ảnh ở dưới, file upload sẽ được ưu tiên.</div>
        @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      {{-- Cách 2: Upload ảnh --}}
      <div class="mb-3">
        <label class="form-label">Ảnh (upload)</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewBookImg(this)">
        <div class="form-text">PNG/JPG/WebP, tối đa 2MB.</div>
        @error('image') <small class="text-danger">{{ $message }}</small> @enderror

        <img id="bookPreview" class="img-thumbnail mt-2 d-none" style="max-height: 140px;">
      </div>

      <div class="mt-4 d-flex gap-2">
        <button class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>

{{-- preview ảnh nhanh, không phụ thuộc stack --}}
<script>
  function previewBookImg(input){
    const img = document.getElementById('bookPreview');
    if (input.files && input.files[0]) {
      img.src = URL.createObjectURL(input.files[0]);
      img.classList.remove('d-none');
    } else {
      img.classList.add('d-none');
      img.removeAttribute('src');
    }
  }
</script>
@endsection
