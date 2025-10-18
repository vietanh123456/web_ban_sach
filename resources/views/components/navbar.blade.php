@props(['cartCount' => 0])
<nav class="bg-white border-b sticky top-0 z-40">
  <div class="container mx-auto px-4 py-3 flex items-center gap-3">
    <a href="/" class="text-xl font-semibold">📚 Bookstore</a>
    <form action="#" method="GET" class="flex-1 max-w-xl ml-4" onsubmit="return false;">
      <div class="flex">
        <input id="q" name="q" type="search" placeholder="Tìm theo tên, tác giả…"
               class="w-full rounded-l-xl border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button class="rounded-r-xl bg-indigo-600 text-white px-4">Tìm</button>
      </div>
    </form>
    <a href="/cart" class="ml-auto inline-flex items-center gap-2 font-medium">
      🛒 <span>Giỏ hàng</span>
      <span class="inline-flex items-center justify-center min-w-[1.5rem] h-6 text-xs bg-indigo-600 text-white rounded-full px-2">{{ $cartCount }}</span>
    </a>
  </div>
</nav>