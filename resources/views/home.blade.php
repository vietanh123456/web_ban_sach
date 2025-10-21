@extends('layouts.app')

@section('title', 'Trang chủ - Bookstore')

@section('content')
  <div class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Chào mừng đến với Bookstore 📚</h1>
    <p class="text-gray-600">Khám phá kho tàng tri thức phong phú của chúng tôi</p>
  </div>

  @if($books->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($books as $book)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
          <a href="{{ route('books.show', $book->id) }}">
            <img src="{{ $book->image_url ?? 'https://via.placeholder.com/300x400?text=Book+Cover' }}"
                 alt="{{ $book->title }}" class="w-full h-64 object-cover">
          </a>
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800 hover:text-blue-600">
              <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
            </h3>
            <p class="text-gray-500 text-sm mt-1">Tác giả: {{ $book->author }}</p>
            <p class="text-blue-600 font-bold text-lg mt-2">{{ number_format($book->price, 0, ',', '.') }} ₫</p>
            <div class="mt-3 flex justify-between">
              <a href="{{ route('books.show', $book->id) }}"
                 class="text-sm px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 transition">
                Xem chi tiết
              </a>
              <form action="{{ route('cart.add', $book->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="text-sm px-3 py-1.5 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                  🛒 Thêm
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p class="text-center text-gray-500 mt-10">Hiện chưa có sách nào trong cửa hàng.</p>
  @endif
@endsection
