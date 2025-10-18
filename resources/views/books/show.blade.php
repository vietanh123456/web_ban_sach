@extends('layouts.app')
@section('title', 'Chi tiết sách')
@section('content')
  @php
    $b = (object) [
      'title'=>'Clean Code',
      'author'=>'Robert C. Martin',
      'price'=>180000,
      'description'=>'Mô tả mẫu cho trang chi tiết sách.',
      'cover_url'=>asset('images/placeholder-book.jpg'),
    ];
  @endphp
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="rounded-2xl overflow-hidden border bg-white">
      <img src="{{ $b->cover_url }}" alt="{{ $b->title }}" class="w-full object-cover" />
    </div>
    <div>
      <h1 class="text-3xl font-semibold">{{ $b->title }}</h1>
      <p class="text-gray-600 mt-1">Tác giả: <span class="font-medium text-gray-800">{{ $b->author }}</span></p>
      <p class="mt-4">{{ $b->description }}</p>
      <div class="mt-6 flex items-center gap-4">
        <span class="text-2xl font-bold">{{ number_format($b->price, 0, ',', '.') }} đ</span>
        <button class="bg-indigo-600 text-white rounded-xl px-5 py-2" type="button">Thêm vào giỏ</button>
      </div>
    </div>
  </div>
@endsection