<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Xem giỏ hàng
    public function index()
    {
        $userId = auth()->id() ?? 1;

        $cartItems = CartItem::with('book')
            ->where('user_id', $userId)
            ->get();

        $total = $cartItems->sum(fn ($i) => (int)$i->book->price * (int)$i->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Thêm 1 sản phẩm theo book_id
    public function add($id)
    {
        $userId = auth()->id() ?? 1;
        $book   = Book::findOrFail($id);

        $item = CartItem::where('book_id', $book->id)
                        ->where('user_id', $userId)
                        ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id'  => $userId,
                'book_id'  => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')
    ->with('success', 'Đã thêm "' . $book->title . '" vào giỏ!');

    }

    // Cập nhật số lượng (PUT)
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $userId = auth()->id() ?? 1;

        $item = CartItem::where('id', $id)
                        ->where('user_id', $userId)
                        ->firstOrFail();

        $item->quantity = (int)$request->quantity;
        $item->save();

        return back()->with('success', 'Đã cập nhật số lượng.');
    }

    // Xoá hẳn 1 item (DELETE)
    public function remove($id)
    {
        $userId = auth()->id() ?? 1;

        $item = CartItem::where('id', $id)
                        ->where('user_id', $userId)
                        ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Đã xoá sản phẩm khỏi giỏ.');
    }

    // Xoá toàn bộ giỏ (DELETE)
    public function clear()
    {
        $userId = auth()->id() ?? 1;
        CartItem::where('user_id', $userId)->delete();

        return back()->with('success', 'Đã làm trống giỏ hàng.');
    }
}
