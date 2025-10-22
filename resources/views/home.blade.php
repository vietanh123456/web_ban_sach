@extends('layouts.app')

@section('title', 'Trang chủ - Bookstore')

@push('styles')
{{-- Nếu bạn dùng CDN Tailwind, thêm clamp "fake" cho tiêu đề 2 dòng --}}
<style>
  .line-clamp-2{
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
  }
</style>
@endpush

@section('content')
  <div class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Chào mừng đến với Bookstore 📚</h1>
    <p class="text-gray-600">Khám phá kho tàng tri thức phong phú của chúng tôi</p>
  </div>

  @if($books->count())
    <div class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach($books as $book)
        <div class="group relative bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">

          {{-- Badge danh mục (nếu có) --}}
          @if($book->category?->name)
            <span class="absolute z-10 top-3 left-3 text-[11px] px-2 py-0.5 rounded-full bg-blue-600/90 text-white">
              {{ $book->category->name }}
            </span>
          @endif

          {{-- Ảnh bìa giữ tỉ lệ 3/4 --}}
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

              <div class="flex items-center gap-2">
                <a href="{{ route('books.show', $book->id) }}"
                   class="text-xs px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                  Xem chi tiết
                </a>
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
        </div>
      @endforeach
    </div>

    {{-- Phân trang --}}
    <div class="mt-8">
      {{ $books->onEachSide(1)->links() }}
    </div>
  @else
    <p class="text-center text-gray-500 mt-10">Hiện chưa có sách nào trong cửa hàng.</p>
  @endif
@endsection
