<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Form thêm
    public function create()
    {
        return view('admin.categories.create');
    }

    // Xử lý thêm
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created!');
    }

    // Form sửa
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Xử lý sửa
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
    }

    // Xóa danh mục
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted!');
    }
}
