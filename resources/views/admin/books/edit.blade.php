@extends('admin.layouts.app')

@section('title', 'Sửa Sách')

@section('content')
<h2>Sửa Thông Tin Sách</h2>

<form action="{{ route('admin.books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Tên sách</label>
        <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input type="text" name="author" value="{{ $book->author }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Giá</label>
        <input type="number" name="price" value="{{ $book->price }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
