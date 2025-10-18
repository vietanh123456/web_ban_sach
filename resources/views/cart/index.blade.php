@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary fw-bold">🛒 Giỏ hàng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <div class="alert alert-info text-center">
            <p>Giỏ hàng trống. <a href="/" class="btn btn-outline-primary btn-sm ms-2">Mua ngay</a></p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Ảnh bìa</th>
                        <th>Tên sách</th>
                        <th>Tác giả</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td style="width: 100px;">
                            <img src="{{ $item->book->image ?? 'https://via.placeholder.com/80x100' }}" alt="{{ $item->book->title }}" class="img-fluid rounded">
                        </td>
                        <td>{{ $item->book->title }}</td>
                        <td>{{ $item->book->author }}</td>
                        <td>{{ number_format($item->book->price) }} đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="fw-bold text-danger">{{ number_format($item->book->price * $item->quantity) }} đ</td>
                        <td>
                            <a href="{{ route('cart.add', $item->book->id) }}" class="btn btn-sm btn-success me-1">+</a>
                            <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-sm btn-warning me-1">-</a>
                            <a href="{{ route('cart.delete', $item->id) }}" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">
                🧹 Xóa toàn bộ giỏ hàng
            </a>
            <a href="/" class="btn btn-primary ms-2">
                ⬅ Tiếp tục mua sắm
            </a>
        </div>
    @endif
</div>
@endsection
