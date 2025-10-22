@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-sm border border-gray-200 rounded-2xl p-6">
  <h1 class="text-2xl font-bold text-gray-800 mb-4">🎉 Cảm ơn bạn đã đặt hàng!</h1>

  <p class="text-gray-600 mb-6">
    Mã đơn: <span class="font-semibold">#{{ $order->id }}</span> —
    Trạng thái: <span class="font-semibold">{{ strtoupper($order->status) }}</span>
  </p>

  <div class="mb-4">
    <div class="font-semibold mb-2">Thông tin nhận hàng</div>
    <div class="text-gray-700 text-sm">
      <div>👤 {{ $order->name }}</div>
      <div>📞 {{ $order->phone }}</div>
      <div>🏠 {{ $order->address }}</div>
    </div>
  </div>

  <div class="mt-6 flex justify-between items-center">
    <div class="text-xl font-semibold">
      Tổng thanh toán: <span class="text-blue-700">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</span>
    </div>
    <a href="{{ route('home') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
      Tiếp tục mua sắm
    </a>
  </div>
</div>
@endsection
