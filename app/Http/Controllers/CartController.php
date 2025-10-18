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
        // Lấy tất cả các mục trong giỏ hàng kèm thông tin sách
        $cartItems = CartItem::with('book')->get();

        // Trả dữ liệu về view cart/index.blade.php
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Thêm một sản phẩm vào giỏ hàng
     */
    public function add($id)
    {
        // Tìm sách theo ID
        $book = Book::findOrFail($id);

        // Kiểm tra xem sách này đã có trong giỏ hàng chưa
        $item = CartItem::where('book_id', $book->id)->first();

        if ($item) {
            // Nếu đã có, tăng số lượng thêm 1
            $item->quantity += 1;
            $item->save();
        } else {
            // Nếu chưa có, tạo mới
            CartItem::create([
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        // Quay lại trang trước kèm thông báo
        return redirect()->back()->with('success', 'Đã thêm "' . $book->title . '" vào giỏ hàng!');
    }

    /**
     * Giảm số lượng hoặc xóa sản phẩm khỏi giỏ hàng
     */
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);

        if ($item->quantity > 1) {
            // Nếu còn hơn 1, giảm 1
            $item->quantity -= 1;
            $item->save();
        } else {
            // Nếu chỉ còn 1, xóa luôn
            $item->delete();
        }

        return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
    }

    /**
     * Xóa hẳn sản phẩm khỏi giỏ hàng
     */
    public function delete($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    /**
     * Xóa toàn bộ giỏ hàng
     */
    public function clear()
    {
        CartItem::truncate(); // Xóa hết dữ liệu trong bảng cart_items
        return redirect()->back()->with('success', 'Giỏ hàng đã được làm trống!');
    }
}
