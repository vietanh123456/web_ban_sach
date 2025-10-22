@extends('layouts.app')
@section('title', $book->title . ' - Bookstore')

@section('content')
<div class="mx-auto max-w-5xl bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="relative w-full aspect-[3/4] bg-gray-50 rounded-xl overflow-hidden">
      <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/600x800?text=Book+Cover' }}"
           alt="{{ $book->title }}" class="absolute inset-0 w-full h-full object-cover">
    </div>

    <div>
      @if($book->category?->name)
        <span class="inline-block text-xs px-2 py-0.5 rounded-full bg-blue-600/90 text-white mb-3">
          {{ $book->category->name }}
        </span>
      @endif

      <h1 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h1>
      <p class="text-sm text-gray-500 mt-1">Tác giả: <span class="font-medium">{{ $book->author }}</span></p>

      <p class="text-blue-700 font-bold text-2xl mt-4">
        {{ number_format((int)$book->price, 0, ',', '.') }} ₫
      </p>

      <p class="mt-4 text-gray-700 leading-7">
        {{ $book->description ?? 'Chưa có mô tả cho cuốn sách này.' }}
      </p>

      <div class="mt-6 flex items-center gap-3">
        <form action="{{ route('cart.add', $book->id) }}" method="POST">
          @csrf
          <button class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">🛒 Thêm vào giỏ</button>
        </form>
        <a href="{{ route('home') }}" class="px-4 py-2 rounded-md bg-gray-100 hover:bg-gray-200">← Tiếp tục mua</a>
      </div>
    </div>
  </div>
</div>
@endsection
