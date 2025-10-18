@extends('layouts.app')

@section('title', 'Danh sách sách')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📚 Danh sách sách</h1>

        <!-- Ô tìm kiếm -->
        <form action="{{ route('books.index') }}" method="GET" class="flex items-center space-x-2">
            <input 
                type="text" 
                name="search" 
                placeholder="Tìm kiếm theo tên hoặc tác giả..." 
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
            >
            <button 
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
            >
                🔍 Tìm
            </button>
        </form>
    </div>

    @if($books->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 hover:shadow-md transition">
                    <img src="{{ $book->image_url ?? 'https://via.placeholder.com/150x200?text=Book' }}" 
                         alt="{{ $book->title }}" 
                         class="w-full h-56 object-cover rounded-lg mb-3">
                    <h2 class="font-semibold text-lg text-gray-900">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-500">Tác giả: {{ $book->author }}</p>
                    <p class="text-blue-600 font-semibold mt-2">{{ number_format($book->price, 0, ',', '.') }} ₫</p>
                    <a href="{{ route('books.show', $book->id) }}" 
                       class="inline-block mt-3 bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 transition">
                        Xem chi tiết
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center py-10">Không tìm thấy sách phù hợp.</p>
    @endif
</div>
@endsection
