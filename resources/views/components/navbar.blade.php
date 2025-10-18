<nav class="bg-white border-b shadow-sm">
  <div class="container mx-auto px-4 py-3 flex items-center justify-between">
    
    <!-- Logo / Tên trang -->
    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700">
      📚 Bookstore
    </a>

    <!-- Menu chính -->
    <ul class="hidden md:flex space-x-6 text-gray-700 font-medium">
      <li>
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Trang chủ</a>
      </li>
      <li>
        <a href="{{ route('books.index') }}" class="hover:text-blue-600 transition">Sách</a>
      </li>
      <li>
        <a href="{{ route('cart.index') }}" class="hover:text-blue-600 transition">Giỏ hàng</a>
      </li>
    </ul>

    <!-- Biểu tượng giỏ hàng -->
    <div class="flex items-center space-x-4">
      <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition">
        🛒
        @if(($cartCount ?? 0) > 0)
          <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">
            {{ $cartCount }}
          </span>
        @endif
      </a>

      <!-- Nút menu nhỏ -->
      <button id="menuBtn" class="md:hidden text-gray-700 hover:text-blue-600 text-xl">
        ☰
      </button>
    </div>
  </div>

  <!-- Menu responsive -->
  <div id="mobileMenu" class="md:hidden hidden border-t bg-white shadow-sm">
    <ul class="flex flex-col space-y-2 px-4 py-3 text-gray-700 font-medium">
      <li><a href="{{ route('home') }}" class="block hover:text-blue-600">Trang chủ</a></li>
      <li><a href="{{ route('books.index') }}" class="block hover:text-blue-600">Sách</a></li>
      <li><a href="{{ route('cart.index') }}" class="block hover:text-blue-600">Giỏ hàng</a></li>
    </ul>
  </div>

  <script>
    // Ẩn/hiện menu trên mobile
    document.getElementById('menuBtn').addEventListener('click', () => {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });
  </script>
</nav>
