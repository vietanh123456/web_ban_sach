<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm trong giỏ hàng
     */
    public function index()
    {
        // Nếu có đăng nhập, lấy giỏ hàng theo user; nếu chưa, tạm mặc định user_id = 1
        $userId = auth()->id() ?? 1;

        $cartItems = CartItem::with('book')
            ->where('user_id', $userId)
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    /**
     * Thêm một sản phẩm vào giỏ hàng
     */
    public function add($id)
    {
        $userId = auth()->id() ?? 1; // Nếu chưa có login, mặc định user_id = 1
        $book = Book::findOrFail($id);

        // Kiểm tra xem sản phẩm đã có trong giỏ chưa
        $item = CartItem::where('book_id', $book->id)
            ->where('user_id', $userId)
            ->first();

        if ($item) {
            // Nếu có, tăng số lượng
            $item->quantity += 1;
            $item->save();
        } else {
            // Nếu chưa, tạo mới
            CartItem::create([
                'user_id' => $userId,
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm "' . $book->title . '" vào giỏ hàng!');
    }

    /**
     * Giảm số lượng hoặc xóa sản phẩm khỏi giỏ hàng
     */
    public function remove($id)
    {
        $userId = auth()->id() ?? 1;

        $item = CartItem::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        } else {
            $item->delete();
        }

        return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    /**
     * Xóa hẳn một sản phẩm khỏi giỏ hàng
     */
    public function delete($id)
    {
        $userId = auth()->id() ?? 1;

        $item = CartItem::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $item->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    /**
     * Xóa toàn bộ giỏ hàng của user
     */
    public function clear()
    {
        $userId = auth()->id() ?? 1;

        CartItem::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', 'Giỏ hàng đã được làm trống!');
    }
}
