@extends('admin.layouts.app')

@section('title','Sửa sách')

@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title mb-3">Sửa sách: <strong>{{ $book->title }}</strong></h5>

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

    <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
        <input type="text" name="title" value="{{ old('title',$book->title) }}" class="form-control" required>
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input type="text" name="author" value="{{ old('author',$book->author) }}" class="form-control">
        @error('author') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Giá (đ) <span class="text-danger">*</span></label>
        <input type="number" name="price" value="{{ old('price',$book->price) }}" class="form-control" min="0" step="1" required>
        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Danh mục</label>
        <select name="category_id" class="form-select">
          <option value="">-- Không chọn --</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(old('category_id',$book->category_id) == $c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description',$book->description) }}</textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Ảnh (URL)</label>
        <input type="url" name="image_url" value="{{ old('image_url',$book->image_url) }}" class="form-control" placeholder="https://...">
        @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Ảnh (upload)</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewBookImg(this)">
        @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror

        @php $current = $book->cover_url; @endphp
        @if($current)
          <div class="mt-2">
            <img id="bookPreview" src="{{ $current }}" class="img-thumbnail" style="max-height:120px">
            <div class="form-text">Ảnh hiện tại</div>
          </div>
        @else
          <img id="bookPreview" class="img-thumbnail mt-2 d-none" style="max-height:120px">
        @endif
      </div>

      <div class="mt-4 d-flex gap-2">
        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>

<script>
  function previewBookImg(input){
    const img = document.getElementById('bookPreview');
    if (input.files && input.files[0]) {
      img.src = URL.createObjectURL(input.files[0]);
      img.classList.remove('d-none');
    }
  }
</script>
@endsection
