@extends('admin.layouts.app')

@section('title', 'Thêm Sách')

@section('content')
<h2>Thêm Sách Mới</h2>

<form action="{{ route('admin.books.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tên sách</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input type="text" name="author" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Giá</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
