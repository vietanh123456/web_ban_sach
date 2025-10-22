@extends('layouts.app')

@section('title', 'Sách - Bookstore')

@push('styles')
<style>
  .line-clamp-2{ display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
</style>
@endpush

@section('content')
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Tất cả sách</h1>
    <p class="text-gray-600">Tìm kiếm & lọc theo danh mục.</p>
  </div>

  {{-- Bộ lọc --}}
  <form method="GET" action="{{ route('books.index') }}" class="mb-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
    <div>
      <label class="block text-sm text-gray-600 mb-1">Tìm kiếm</label>
      <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Tên sách, tác giả..."
             class="w-full rounded-lg border px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm text-gray-600 mb-1">Danh mục</label>
      <select name="category_id" class="w-full rounded-lg border px-3 py-2">
        <option value="">Tất cả</option>
        @foreach($categories as $c)
          <option value="{{ $c->id }}" @selected(($categoryId ?? '') == $c->id)>{{ $c->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex items-end">
      <button class="w-full rounded-lg bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">Lọc</button>
    </div>
  </form>

  @if($books->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach($books as $book)
        <div class="group relative bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">
          {{-- Badge danh mục --}}
          @if($book->category?->name)
            <span class="absolute z-10 top-3 left-3 text-[11px] px-2 py-0.5 rounded-full bg-blue-600/90 text-white">
              {{ $book->category->name }}
            </span>
          @endif

          {{-- Ảnh bìa tỉ lệ 3/4 --}}
          <a href="{{ route('books.show', $book->id) }}" class="block">
            <div class="relative w-full aspect-[3/4] bg-gray-50">
              <img
                src="{{ $book->cover_url ?? 'https://via.placeholder.com/600x800?text=Book+Cover' }}"
                alt="{{ $book->title }}"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-300"
              />
            </div>
          </a>

          <div class="p-4">
            <a href="{{ route('books.show', $book->id) }}" class="block">
              <h3 class="text-base font-semibold text-gray-800 mb-1 line-clamp-2 hover:text-blue-700">
                {{ $book->title }}
              </h3>
            </a>

            <p class="text-xs text-gray-500 mb-2">
              Tác giả: <span class="font-medium">{{ $book->author }}</span>
            </p>

            <div class="flex items-center justify-between">
              <p class="text-blue-700 font-bold text-lg">
                {{ number_format((int)$book->price, 0, ',', '.') }} ₫
              </p>

              <form action="{{ route('cart.add', $book->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="text-xs px-3 py-1.5 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                  🛒 Thêm
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Phân trang --}}
    <div class="mt-8">
      {{ $books->onEachSide(1)->links() }}
    </div>
  @else
    <div class="text-center py-10">
      <p class="text-gray-500">Không tìm thấy sách phù hợp.</p>
      <a href="{{ route('books.index') }}" class="inline-block mt-3 rounded-lg bg-gray-100 px-4 py-2 hover:bg-gray-200">Xóa bộ lọc</a>
    </div>
  @endif
@endsection
