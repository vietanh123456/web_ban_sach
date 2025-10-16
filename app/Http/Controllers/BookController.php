<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Hiển thị danh sách sách
    public function index()
    {
        return Book::all();
    }

    // Xem chi tiết 1 sách
    public function show($id)
    {
        return Book::findOrFail($id);
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
