@php
  $b = (object) array_merge([
    'id' => 0,
    'title' => 'Sách mẫu',
    'author' => 'Tác giả A',
    'price' => 125000,
    'cover_url' => asset('images/placeholder-book.jpg'),
  ], is_array($book ?? null) ? $book : (array)($book ?? []));
@endphp
<a href="/books/{{ $b->id }}" class="group block rounded-2xl border bg-white overflow-hidden hover:shadow-md transition">
  <div class="aspect-[3/4] bg-gray-100 flex items-center justify-center">
    <img src="{{ $b->cover_url }}" alt="{{ $b->title }}"
         class="h-full w-full object-cover group-hover:scale-[1.02] transition" />
  </div>
  <div class="p-4">
    <h3 class="font-semibold leading-snug line-clamp-2">{{ $b->title }}</h3>
    <p class="mt-1 text-sm text-gray-500 line-clamp-1">{{ $b->author }}</p>
    <div class="mt-3 flex items-center justify-between">
      <span class="font-bold">{{ number_format($b->price, 0, ',', '.') }} đ</span>
      <button class="text-sm bg-indigo-600 text-white rounded-xl px-3 py-1.5" type="button">Thêm</button>
    </div>
  </div>
</a>