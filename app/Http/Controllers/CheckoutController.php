<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckoutController extends Controller
{
    /**
     * Trang tóm tắt giỏ + form thông tin nhận hàng.
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // routes đã bọc middleware('auth')
        $cartItems = CartItem::with('book')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = $cartItems->sum(fn ($i) => (int) $i->book->price * (int) $i->quantity);

        return view('checkout.index', [
            'cartItems' => $cartItems,
            'total'     => $total,
        ]);
    }

    /**
     * Đặt hàng (tạo Order + OrderItem) rồi xoá giỏ.
     */
    public function place(Request $request)
    {
        $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'phone'   => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:500'],
            'note'    => ['nullable', 'string', 'max:1000'],
        ]);

        $userId = Auth::id();

        $cartItems = CartItem::with('book')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Giỏ hàng trống.');
        }

        $total = $cartItems->sum(fn ($i) => (int) $i->book->price * (int) $i->quantity);

        $order = DB::transaction(function () use ($request, $userId, $cartItems, $total) {

            // Payload cơ bản
            $payload = [
                'user_id'        => $userId,
                'total_amount'   => (int) $total,
                'status'         => 'pending',
                'customer_name'  => $request->name,
                'customer_phone' => $request->phone,
                'customer_addr'  => $request->address,
                'note'           => $request->note,
            ];

            // Nếu DB còn cột total_price (NOT NULL) thì gán thêm để tránh lỗi
            if (Schema::hasColumn('orders', 'total_price')) {
                $payload['total_price'] = (int) $total;
            }

            $order = Order::create($payload);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id'  => $item->book_id,
                    'price'    => (int) $item->book->price,
                    'quantity' => (int) $item->quantity,
                ]);
            }

            // Xoá giỏ sau khi tạo đơn
            CartItem::where('user_id', $userId)->delete();

            return $order;
        });

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Đặt hàng thành công!');
    }

    /**
     * Trang xem chi tiết đơn (cảm ơn).
     */
    public function show(Order $order)
    {
        // Nếu chưa dùng Policy thì chặn truy cập chéo user
        if (Auth::id() !== $order->user_id) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        $order->load('items.book');

        return view('orders.show', ['order' => $order]);
    }
}
