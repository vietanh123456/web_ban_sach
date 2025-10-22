<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // URL ảnh (nếu bạn dán link ảnh trực tiếp)
            $table->string('image_url', 2048)->nullable()->after('author');

            // Đường dẫn file ảnh đã upload vào storage/public (ví dụ: books/abc.jpg)
            $table->string('image_path')->nullable()->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['image_url', 'image_path']);
        });
    }
};
