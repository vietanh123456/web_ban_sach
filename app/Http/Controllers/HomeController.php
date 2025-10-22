<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('category')
            ->latest('id')
            ->paginate(12)           // 12 cuốn mỗi trang
            ->withQueryString();     // giữ query nếu sau này có filter/search

        return view('home', compact('books'));
    }
}
