<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Hiển thị danh sách sách
    public function index(Request $request)
    {
        $query = Book::with('category');

        // Lọc theo từ khóa
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // Lọc theo thể loại (category_id)
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->get();
        $categories = Category::all(); // lấy danh sách thể loại

        return view('books.index', compact('books', 'categories'));
    }


    // Xem chi tiết 1 sách
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Thêm sách mới
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    // Cập nhật thông tin sách
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    // Xóa sách
    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(null, 204);
    }
}
