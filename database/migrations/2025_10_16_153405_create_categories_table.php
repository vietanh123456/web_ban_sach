<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Chạy migration: tạo bảng categories.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('name'); // Tên danh mục
            $table->text('description')->nullable(); // Mô tả (có thể bỏ trống)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Hoàn tác migration (xóa bảng categories).
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
