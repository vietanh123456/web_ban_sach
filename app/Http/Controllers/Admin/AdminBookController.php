<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBookController extends Controller
{
    // Danh sách sách
    public function index()
    {
        $books = Book::with('category')->latest('id')->get();
        return view('admin.books.index', compact('books'));
    }

    // Form thêm mới
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    // Lưu sách mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'price'       => ['required', 'numeric', 'min:0'],
            // ảnh
            'image_url'   => ['nullable', 'url', 'max:2048'],
            'image'       => ['nullable', 'image', 'max:2048'], // 2MB
        ]);

        // Upload file ảnh (ưu tiên file nếu có)
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('books', 'public');
        }

        Book::create($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Thêm sách thành công!');
    }

    // Form sửa
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    // Cập nhật sách
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'price'       => ['required', 'numeric', 'min:0'],
            // ảnh
            'image_url'   => ['nullable', 'url', 'max:2048'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($book->image_path) {
                Storage::disk('public')->delete($book->image_path);
            }
            $data['image_path'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Cập nhật thành công!');
    }

    // Xóa sách
    public function destroy(Book $book)
    {
        // Xóa file ảnh nếu có
        if ($book->image_path) {
            Storage::disk('public')->delete($book->image_path);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Xóa thành công!');
    }
}
