@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Danh mục')

@section('content')
<h2>Chỉnh sửa Danh mục</h2>

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
