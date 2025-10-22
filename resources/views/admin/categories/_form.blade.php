@csrf

<div class="mb-3">
  <label class="form-label">Tên thể loại <span class="text-danger">*</span></label>
  <input type="text"
         name="name"
         value="{{ old('name', $category->name ?? '') }}"
         class="form-control" required>
</div>

<div class="mb-3">
  <label class="form-label">Mô tả</label>
  <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div class="d-flex gap-2">
  <button class="btn btn-primary">
    {{ $submitLabel ?? 'Lưu' }}
  </button>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
</div>
