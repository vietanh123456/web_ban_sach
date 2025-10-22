<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Bookstore')</title>

  {{-- Tailwind CDN (đủ dùng cho UI hiện tại) --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Font --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', system-ui, Arial, sans-serif; background-color: #f9fafb; }
    main { min-height: 80vh; }
    /* Fake line-clamp khi dùng Tailwind CDN */
    .line-clamp-2{ display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
  </style>

  {{-- Bootstrap chỉ để tận dụng alert/nút nếu cần --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Cho phép view con đẩy thêm CSS nếu cần --}}
  @stack('styles')
</head>
<body class="text-gray-900">

  {{-- Navbar (sticky + blur nhẹ) --}}
  <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
    <div class="container mx-auto max-w-7xl px-4">
      @include('components.navbar', ['cartCount' => $cartCount ?? 0])
    </div>
  </header>

  {{-- Main content --}}
  <main class="container mx-auto max-w-7xl px-4 py-6">
    @include('components.alert')
    @yield('content')
  </main>

  {{-- Footer --}}
  <footer class="border-t mt-12 bg-white shadow-sm">
    <div class="container mx-auto max-w-7xl px-4 py-6 text-sm text-gray-600 flex flex-col sm:flex-row justify-between items-center">
      <p>© {{ date('Y') }} <span class="font-semibold">Bookstore</span>. All rights reserved.</p>
      <p>UI built with <span class="text-blue-600">Laravel + Tailwind</span>.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Cho phép view con đẩy thêm script nếu cần --}}
  @stack('scripts')
</body>
</html>
