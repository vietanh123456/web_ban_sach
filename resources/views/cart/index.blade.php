@extends('layouts.app')

@section('title', 'Giỏ hàng của bạn - Bookstore')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-sm border border-gray-200 rounded-2xl p-6">

  <h1 class="text-2xl font-bold text-gray-800 mb-6">🛒 Giỏ hàng của bạn</h1>

  @if(count($cartItems) > 0)
    <div class="overflow-x-auto">
      <table class="table-auto w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 text-gray-700">
            <th class="px-4 py-3 rounded-tl-lg">Sách</th>
            <th class="px-4 py-3">Giá</th>
            <th class="px-4 py-3">Số lượng</th>
            <th class="px-4 py-3">Tổng</th>
            <th class="px-4 py-3 rounded-tr-lg">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cartItems as $item)
            <tr class="border-b hover:bg-gray-50 transition">
              <td class="px-4 py-3">
                <div class="flex items-center gap-4">
                  <img
                    src="{{ $item->book->cover_url ?? 'https://via.placeholder.com/60x80?text=Book' }}"
                    alt="{{ $item->book->title }}"
                    class="w-16 h-20 object-cover rounded-lg border"
                  >
                  <div>
                    <p class="font-medium text-gray-800">{{ $item->book->title }}</p>
                    <p class="text-sm text-gray-500">Tác giả: {{ $item->book->author }}</p>
                  </div>
                </div>
              </td>

              <td class="px-4 py-3 text-blue-600 font-semibold whitespace-nowrap">
                {{ number_format($item->book->price, 0, ',', '.') }} ₫
              </td>

              <td class="px-4 py-3">
                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-flex items-center">
                  @csrf
                  @method('PUT')

                  <label for="qty-{{ $item->id }}" class="sr-only">Số lượng</label>
                  <input
                    id="qty-{{ $item->id }}"
                    type="number"
                    name="quantity"
                    value="{{ $item->quantity }}"
                    min="1"
                    class="w-20 border rounded-md px-2 py-1 text-center text-gray-700"
                  >

                  <button type="submit"
                          class="ml-2 text-sm bg-blue-500 text-white px-3 py-1.5 rounded-md hover:bg-blue-600 transition">
                    Cập nhật
                  </button>
                </form>
              </td>

              <td class="px-4 py-3 font-semibold text-gray-800 whitespace-nowrap">
                {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }} ₫
              </td>

              <td class="px-4 py-3">
                <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="text-red-500 hover:text-red-600 transition font-medium">
                    🗑 Xóa
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Tổng tiền + hành động --}}
    <div class="mt-6 flex flex-col sm:flex-row justify-between items-center">
      <p class="text-xl font-semibold text-gray-800">
        Tổng cộng:
        <span class="text-blue-600">{{ number_format($total, 0, ',', '.') }} ₫</span>
      </p>

      <div class="mt-4 sm:mt-0 space-x-3">
        <a href="{{ route('home') }}"
           class="bg-gray-200 text-gray-700 px-5 py-2 rounded-md hover:bg-gray-300 transition">
          ← Tiếp tục mua hàng
        </a>

        @auth
          <a href="{{ route('checkout.index') }}"
             class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition">
            💳 Thanh toán
          </a>
        @else
          <a href="{{ route('login') }}"
             class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
            Đăng nhập để thanh toán
          </a>
        @endauth
      </div>
    </div>
  @else
    <div class="text-center py-10">
      <p class="text-gray-500 text-lg">Giỏ hàng của bạn đang trống.</p>
      <a href="{{ route('home') }}"
         class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
        🛍 Mua sắm ngay
      </a>
    </div>
  @endif

</div>
@endsection
