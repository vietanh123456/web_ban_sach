@extends('admin.layouts.app')

@section('title', 'Thêm Danh mục')

@section('content')
<h2>Thêm Danh mục</h2>

<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
