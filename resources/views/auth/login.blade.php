@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="flex items-center justify-center">
  <div class="w-full max-w-md">
    <div class="bg-white shadow-md rounded-2xl border border-gray-200 overflow-hidden">
      <div class="px-6 py-5 border-b">
        <h1 class="text-xl font-semibold text-gray-800">Đăng nhập</h1>
        <p class="text-sm text-gray-500 mt-1">Chào mừng quay lại Bookstore</p>
      </div>

      <div class="px-6 py-5">
        {{-- lỗi validate --}}
        @if ($errors->any())
          <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
          @csrf

          <div>
            <label class="block text-sm text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
          </div>

          <div>
            <label class="block text-sm text-gray-700 mb-1">Mật khẩu</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
          </div>

          <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-gray-600">
              <input type="checkbox" name="remember" class="rounded"> Ghi nhớ đăng nhập
            </label>
            {{-- Nếu có route quên mật khẩu thì mở link này --}}
            {{-- <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Quên mật khẩu?</a> --}}
          </div>

          <button type="submit"
                  class="w-full rounded-lg bg-blue-600 text-white py-2.5 font-medium hover:bg-blue-700 transition">
            Đăng nhập
          </button>
        </form>

        <p class="text-sm text-gray-600 mt-5">
          Chưa có tài khoản?
          <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Đăng ký</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
