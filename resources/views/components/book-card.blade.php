@props(['book'])

@php
  $img = $book->cover_url ?? 'https://via.placeholder.com/600x800?text=Book+Cover';
  $price = number_format((int) $book->price, 0, ',', '.').' ₫';
@endphp

<div class="group relative bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
  {{-- Ảnh bìa, cố định tỉ lệ --}}
  <a href="{{ route('books.show', $book->id) }}" class="block overflow-hidden rounded-t-2xl">
    <div class="relative w-full aspect-[3/4] bg-gray-50">
      <img src="{{ $img }}" alt="{{ $book->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-300">
    </div>
  </a>

  {{-- Danh mục (nếu có) --}}
  @if($book->category?->name)
    <span class="absolute top-3 left-3 text-[11px] px-2 py-0.5 rounded-full bg-blue-600/90 text-white">
      {{ $book->category->name }}
    </span>
  @endif

  <div class="p-4">
    {{-- Tên sách --}}
    <a href="{{ route('books.show', $book->id) }}" class="block">
      <h3 class="text-base font-semibold text-gray-800 mb-1 line-clamp-2">
        {{ $book->title }}
      </h3>
    </a>

    {{-- Tác giả --}}
    <p class="text-xs text-gray-500 mb-2">Tác giả: <span class="font-medium">{{ $book->author }}</span></p>

    {{-- Giá --}}
    <div class="flex items-center justify-between">
      <p class="text-blue-700 font-bold text-lg">{{ $price }}</p>

      {{-- Actions --}}
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
