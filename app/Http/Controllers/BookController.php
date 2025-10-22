<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Hiển thị danh sách sách (tìm kiếm, lọc theo danh mục, phân trang).
     */
    public function index(Request $request)
    {
        $search     = trim((string) $request->get('search', ''));
        $categoryId = $request->get('category_id');

        $books = Book::with('category')
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($x) use ($search) {
                    $x->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%");
                });
            })
            ->when(!empty($categoryId), fn ($q) => $q->where('category_id', $categoryId))
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('books.index', [
            'books'      => $books,
            'categories' => $categories,
            'search'     => $search,
            'categoryId' => $categoryId,
        ]);
    }

    /**
     * Hiển thị chi tiết một sách.
     */
    public function show(int $id)
    {
        $book = Book::with('category')->findOrFail($id);

        return view('books.show', [
            'book' => $book,
        ]);
    }
}
