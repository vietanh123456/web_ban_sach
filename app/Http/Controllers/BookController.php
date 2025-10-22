<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Danh sách sách (có tìm kiếm + lọc + phân trang)
    public function index(Request $request)
    {
        $search     = trim((string) $request->get('search', ''));
        $categoryId = $request->get('category_id');

        $books = Book::with('category')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($x) use ($search) {
                    $x->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories', 'search', 'categoryId'));
    }

    // Chi tiết 1 sách
    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    // (Các method store/update/destroy của bạn để nguyên nếu đang dùng API/admin)
}
