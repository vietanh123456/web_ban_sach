@extends('admin.layouts.app')

@section('title', 'Quản lý Sách')

@section('content')
<h2>Danh sách Sách</h2>

<a href="{{ route('admin.books.create') }}" class="btn btn-primary mb-3">+ Thêm sách</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ number_format($book->price, 0, ',', '.') }} đ</td>
            <td>
                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa sách này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
