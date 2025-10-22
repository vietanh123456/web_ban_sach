@php
  $is = fn ($pattern) => request()->routeIs($pattern) ? 'text-blue-700 font-semibold' : 'text-gray-600 hover:text-gray-900';
@endphp

<nav class="w-full bg-white">
  <div class="mx-auto max-w-7xl px-4">
    <div class="flex h-14 items-center justify-between border-b">

      {{-- Left: Logo + desktop menu --}}
      <div class="flex items-center gap-8">
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-semibold text-gray-900">
          📚 <span>Bookstore</span>
        </a>

        <ul class="hidden md:flex items-center gap-6 text-sm">
          <li><a href="{{ route('home') }}" class="{{ $is('home') }}">Trang chủ</a></li>
          <li><a href="{{ route('books.index') }}" class="{{ $is('books.index') }}">Sách</a></li>
          <li class="relative">
            <a href="{{ route('cart.index') }}" class="{{ $is('cart.index') }}">
              Giỏ hàng
              @if(($cartCount ?? 0) > 0)
                <span class="absolute -top-2 -right-3 text-[11px] leading-none px-1.5 py-0.5 rounded-full bg-blue-600 text-white">
                  {{ $cartCount }}
                </span>
              @endif
            </a>
          </li>
        </ul>
      </div>

      {{-- Right: auth actions (desktop) --}}
      <div class="hidden md:flex items-center gap-2">
        @auth
          <span class="text-sm text-gray-600">Hi, {{ Str::limit(auth()->user()->name,18) }}</span>

          @if(auth()->user()->is_admin)
            <a href="{{ route('admin.index') }}"
               class="px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm">Admin</a>
          @endif

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-3 py-1.5 rounded-lg bg-gray-900 text-white hover:bg-black text-sm">Đăng xuất</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-lg border text-sm hover:bg-gray-50">Đăng nhập</a>
          <a href="{{ route('register') }}" class="px-3 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm">Đăng ký</a>
        @endauth
      </div>

      {{-- Mobile: hamburger + sheet (no JS needed) --}}
      <details class="md:hidden relative">
        <summary class="list-none cursor-pointer rounded-lg border px-2 py-1.5 text-sm text-gray-700 hover:bg-gray-50">
          ☰
        </summary>
        <div class="absolute right-0 mt-2 w-56 rounded-xl border bg-white shadow-lg p-3 space-y-2 z-50">

          <a href="{{ route('home') }}" class="block px-2 py-2 rounded-md {{ $is('home') }}">Trang chủ</a>
          <a href="{{ route('books.index') }}" class="block px-2 py-2 rounded-md {{ $is('books.index') }}">Sách</a>

          <a href="{{ route('cart.index') }}" class="block px-2 py-2 rounded-md {{ $is('cart.index') }}">
            Giỏ hàng
            @if(($cartCount ?? 0) > 0)
              <span class="ml-1 inline-block rounded-full bg-blue-600 px-1.5 py-0.5 text-[10px] text-white align-middle">
                {{ $cartCount }}
              </span>
            @endif
          </a>

          <hr class="my-1">

          @auth
            @if(auth()->user()->is_admin)
              <a href="{{ route('admin.index') }}" class="block px-2 py-2 rounded-md hover:bg-gray-50">Trang admin</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="pt-1">
              @csrf
              <button class="w-full text-left px-2 py-2 rounded-md bg-gray-900 text-white hover:bg-black text-sm">
                Đăng xuất
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="block px-2 py-2 rounded-md border hover:bg-gray-50 text-sm">Đăng nhập</a>
            <a href="{{ route('register') }}" class="block px-2 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 text-sm">Đăng ký</a>
          @endauth
        </div>
      </details>

    </div>
  </div>
</nav>
