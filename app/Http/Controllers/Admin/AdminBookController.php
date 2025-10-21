<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    // Hiển thị danh sách sách
    public function index()
    {
        $books = Book::with('category')->get();
        return view('admin.books.index', compact('books'));
    }

    // Form thêm mới
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    // Lưu sách mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'nullable|numeric',
        ]);

        Book::create($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Thêm sách thành công!');
    }

    // Form sửa
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    // Cập nhật sách
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'nullable|numeric',
        ]);

        $book->update($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa sách
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Xóa thành công!');
    }
}
