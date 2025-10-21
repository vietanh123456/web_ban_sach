<nav class="w-full border-b bg-white">
  <div class="mx-auto max-w-6xl px-4">
    <div class="flex h-14 items-center justify-between">
      {{-- Logo + menu trái --}}
      <div class="flex items-center gap-8">
        <a href="{{ url('/') }}" class="font-semibold text-blue-600 flex items-center gap-2">
          📚 <span>Bookstore</span>
        </a>
        <div class="hidden md:flex items-center gap-6 text-sm text-gray-600">
          <a href="{{ url('/') }}" class="hover:text-gray-900">Trang chủ</a>
          <a href="{{ route('books.index') }}" class="hover:text-gray-900">Sách</a>
          <a href="{{ route('cart.index') }}" class="hover:text-gray-900">Giỏ hàng</a>
        </div>
      </div>

      {{-- Auth --}}
      <div class="flex items-center gap-2">
        @auth
          <span class="hidden sm:inline text-sm text-gray-700">Hi, {{ Auth::user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="rounded-lg border px-3 py-1.5 text-sm hover:bg-gray-50">
              Đăng xuất
            </button>
          </form>
        @else
          <a href="{{ route('login') }}"
             class="rounded-lg border px-3 py-1.5 text-sm hover:bg-gray-50">Đăng nhập</a>
          <a href="{{ route('register') }}"
             class="rounded-lg bg-blue-600 px-3 py-1.5 text-sm text-white hover:bg-blue-700">Đăng ký</a>
        @endauth
      </div>
    </div>
  </div>
</nav>
