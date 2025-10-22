<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->count() === 0) {
            $this->command->warn('⚠️ Chưa có category nào. Hãy chạy CategorySeeder trước!');
            return;
        }

        // Mỗi sách một ảnh khác nhau (link ảnh public)
        $books = [
            [
                'title'       => 'Lập Trình Laravel Cơ Bản',
                'author'      => 'Nguyễn Văn A',
                'price'       => 120000,
                'description' => 'Cuốn sách hướng dẫn học Laravel từ cơ bản đến nâng cao.',
                'image'       => 'https://m.media-amazon.com/images/I/71JkF2sVknL.jpg', // Laravel Up & Running cover
            ],
            [
                'title'       => 'Python Cho Người Mới Bắt Đầu',
                'author'      => 'Trần Thị B',
                'price'       => 95000,
                'description' => 'Khám phá ngôn ngữ lập trình Python một cách dễ hiểu và thực tế.',
                'image'       => 'https://m.media-amazon.com/images/I/51F4tkjZq-L.jpg', // Python Crash Course cover
            ],
            [
                'title'       => 'Học Máy Và Trí Tuệ Nhân Tạo',
                'author'      => 'Phạm Văn C',
                'price'       => 180000,
                'description' => 'Nhập môn Machine Learning và các ứng dụng AI phổ biến.',
                'image'       => 'https://m.media-amazon.com/images/I/71m3GZ4Z0eL.jpg', // Deep Learning (Goodfellow) cover
            ],
            [
                'title'       => 'Tiếng Anh Giao Tiếp Cơ Bản',
                'author'      => 'Lê Thị D',
                'price'       => 80000,
                'description' => 'Sách luyện tập giao tiếp tiếng Anh qua các tình huống thực tế.',
                'image'       => 'public/images/book1.jpg', // English Grammar in Use cover
            ],
        ];

        foreach ($books as $data) {
            $data['category_id'] = $categories->random()->id;
            Book::create($data);
        }

        $this->command->info('✅ Đã thêm dữ liệu mẫu cho bảng books!');
    }
}
