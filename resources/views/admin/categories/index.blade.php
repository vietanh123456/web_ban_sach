@extends('admin.layouts.app')

@section('title', 'Danh mục Sách')

@section('content')
<h2>Danh sách Danh mục</h2>

<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Thêm danh mục</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->name }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
