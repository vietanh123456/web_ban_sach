@extends('layouts.app')
@section('title','Đơn hàng')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-6">
  <h1 class="text-xl font-semibold mb-4">Cảm ơn bạn đã đặt hàng 🎉</h1>

  <p class="text-gray-600 mb-4">Mã đơn: <span class="font-medium">#{{ $order->id }}</span></p>

  <div class="mb-6">
    @foreach($order->items as $item)
      <div class="flex justify-between py-2 border-b">
        <div>
          <div class="font-medium">{{ $item->book->title }}</div>
          <div class="text-sm text-gray-500">x{{ $item->quantity }}</div>
        </div>
        <div class="font-semibold">
          {{ number_format($item->price * $item->quantity, 0, ',', '.') }} ₫
        </div>
      </div>
    @endforeach
    <div class="flex justify-between py-3 text-lg font-bold">
      <span>Tổng cộng</span>
      <span class="text-blue-700">{{ number_format($order->total_amount, 0, ',', '.') }} ₫</span>
    </div>
  </div>

  <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg border">← Tiếp tục mua sắm</a>
</div>
@endsection
