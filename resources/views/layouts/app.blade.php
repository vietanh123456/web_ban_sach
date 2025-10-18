<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Bookstore')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style> body{font-family:Inter,system-ui,Arial,sans-serif} </style>
</head>
<body class="bg-gray-50 text-gray-900">
  @include('components.navbar', ['cartCount' => $cartCount ?? 0])
  <main class="container mx-auto px-4 py-6">
    @include('components.alert')
    @yield('content')
  </main>
  <footer class="border-t mt-12">
    <div class="container mx-auto px-4 py-6 text-sm text-gray-500 flex items-center justify-between">
      <p>© {{ date('Y') }} Bookstore.</p>
      <p>UI demo – Laravel Blade + Tailwind.</p>
    </div>
  </footer>
</body>
</html>