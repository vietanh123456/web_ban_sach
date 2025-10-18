@extends('layouts.app')

@section('title', $book->title . ' - Bookstore')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden">
  <div class="grid grid-cols-1 md:grid-cols-2">
    
    <!-- Ảnh bìa sách -->
    <div class="bg-gray-100 flex justify-center items-center">
      <img src="{{ $book->image_url ?? 'https://via.placeholder.com/400x500?text=Book+Cover' }}"
           alt="{{ $book->title }}"
           class="w-full md:w-4/5 h-full object-cover p-4 rounded-xl">
    </div>

    <!-- Thông tin sách -->
    <div class="p-6 flex flex-col justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>
        <p class="text-gray-600 mb-3">Tác giả: <span class="font-medium">{{ $book->author }}</span></p>
        <p class="text-2xl font-semibold text-blue-600 mb-4">{{ number_format($book->price, 0, ',', '.') }} ₫</p>

        <div class="prose text-gray-700 leading-relaxed">
          {!! nl2br(e($book->description ?? 'Chưa có mô tả cho quyển sách này.')) !!}
        </div>
      </div>

      <!-- Nút thêm vào giỏ hàng -->
      <div class="mt-6 flex items-center space-x-3">
        <form action="{{ route('cart.add', $book->id) }}" method="POST">
          @csrf
          <button type="submit"
                  class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition">
            🛒 Thêm vào giỏ hàng
          </button>
        </form>
        <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition">
          ← Quay lại trang chủ
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
