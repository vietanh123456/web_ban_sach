@extends('admin.layouts.app')

@section('title', 'Danh mục Sách')

@section('content')
  {{-- Flash messages --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Danh sách Danh mục</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
  </div>

  <div class="card">
    <div class="card-body p-0">
      <table class="table table-hover table-striped mb-0">
        <thead class="table-light">
          <tr>
            <th style="width:80px">ID</th>
            <th>Tên danh mục</th>
            <th style="width:180px" class="text-end">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $cat)
            <tr>
              <td>{{ $cat->id }}</td>
              <td>{{ $cat->name }}</td>
              <td class="text-end">
                <a href="{{ route('admin.categories.edit', $cat->id) }}"
                   class="btn btn-sm btn-warning">Sửa</a>

                <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Xóa danh mục này?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center text-muted py-4">
                Chưa có danh mục nào.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Nếu controller dùng paginate() thì hiện phân trang --}}
  @if(method_exists($categories, 'links'))
    <div class="mt-3">
      {{ $categories->links() }}
    </div>
  @endif
@endsection
