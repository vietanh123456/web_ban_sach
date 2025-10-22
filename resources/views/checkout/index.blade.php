@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-sm border border-gray-200 rounded-2xl p-6">
  <h1 class="text-2xl font-bold text-gray-800 mb-6">🧾 Thanh toán</h1>

  {{-- Tóm tắt giỏ hàng --}}
  <div class="mb-6 overflow-x-auto">
    <table class="table-auto w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-100 text-gray-700">
          <th class="px-4 py-3 rounded-tl-lg">Sách</th>
          <th class="px-4 py-3">Giá</th>
          <th class="px-4 py-3">SL</th>
          <th class="px-4 py-3 rounded-tr-lg">Tổng</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cartItems as $item)
          <tr class="border-b">
            <td class="px-4 py-3 flex items-center gap-3">
              <img src="{{ $item->book->cover_url ?? 'https://via.placeholder.com/60x80?text=Book' }}"
                   class="w-12 h-16 object-cover rounded border" alt="">
              <div>
                <div class="font-medium text-gray-800">{{ $item->book->title }}</div>
                <div class="text-xs text-gray-500">Tác giả: {{ $item->book->author }}</div>
              </div>
            </td>
            <td class="px-4 py-3 text-blue-700 font-semibold">
              {{ number_format($item->book->price, 0, ',', '.') }} ₫
            </td>
            <td class="px-4 py-3">x{{ $item->quantity }}</td>
            <td class="px-4 py-3 font-semibold">
              {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }} ₫
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Tổng cộng --}}
  <div class="flex justify-end mb-6">
    <div class="text-xl font-semibold">
      Tổng cộng: <span class="text-blue-700">{{ number_format($total, 0, ',', '.') }} ₫</span>
    </div>
  </div>

  {{-- Form thông tin nhận hàng --}}
  <form method="POST" action="{{ route('checkout.place') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf
    <div class="col-span-1">
      <label class="block text-sm text-gray-600">Họ tên</label>
      <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
             class="w-full rounded border px-3 py-2" required>
      @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="col-span-1">
      <label class="block text-sm text-gray-600">Số điện thoại</label>
      <input type="text" name="phone" value="{{ old('phone') }}"
             class="w-full rounded border px-3 py-2" required>
      @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
      <label class="block text-sm text-gray-600">Địa chỉ</label>
      <input type="text" name="address" value="{{ old('address') }}"
             class="w-full rounded border px-3 py-2" required>
      @error('address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2 flex justify-between mt-2">
      <a href="{{ route('cart.index') }}"
         class="px-4 py-2 rounded border text-gray-700 hover:bg-gray-50">← Quay lại giỏ hàng</a>
      <button class="px-5 py-2 rounded bg-green-600 text-white hover:bg-green-700">
        ✅ Đặt hàng
      </button>
    </div>
  </form>
</div>
@endsection
