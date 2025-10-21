<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong database (nếu bạn dùng tên khác với mặc định "categories")
     * Mặc định Laravel sẽ tự hiểu là "categories" dựa vào tên model "Category"
     */
    protected $table = 'categories';

    /**
     * Các cột được phép gán hàng loạt (mass assignment)
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Mối quan hệ: Một Category có nhiều Book
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Hàm hiển thị tên danh mục khi gọi dưới dạng chuỗi
     */
    public function __toString()
    {
        return $this->name;
    }
}
