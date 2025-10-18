<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy danh sách các category có sẵn
        $categories = Category::all();

        // Nếu chưa có category, dừng lại
        if ($categories->count() == 0) {
            $this->command->warn('⚠️ Chưa có category nào. Hãy chạy CategorySeeder trước!');
            return;
        }

        // Dữ liệu mẫu
        $books = [
            [
                'title' => 'Lập Trình Laravel Cơ Bản',
                'author' => 'Nguyễn Văn A',
                'price' => 120000,
                'description' => 'Cuốn sách hướng dẫn học Laravel từ cơ bản đến nâng cao.',
                'image' => 'https://picsum.photos/200/300?random=1',
            ],
            [
                'title' => 'Python Cho Người Mới Bắt Đầu',
                'author' => 'Trần Thị B',
                'price' => 95000,
                'description' => 'Khám phá ngôn ngữ lập trình Python một cách dễ hiểu và thực tế.',
                'image' => 'https://picsum.photos/200/300?random=2',
            ],
            [
                'title' => 'Học Máy Và Trí Tuệ Nhân Tạo',
                'author' => 'Phạm Văn C',
                'price' => 180000,
                'description' => 'Nhập môn Machine Learning và các ứng dụng AI phổ biến.',
                'image' => 'https://picsum.photos/200/300?random=3',
            ],
            [
                'title' => 'Tiếng Anh Giao Tiếp Cơ Bản',
                'author' => 'Lê Thị D',
                'price' => 80000,
                'description' => 'Sách luyện tập giao tiếp tiếng Anh qua các tình huống thực tế.',
                'image' => 'https://picsum.photos/200/300?random=4',
            ],
        ];

        // Gán ngẫu nhiên mỗi sách cho 1 category
        foreach ($books as $bookData) {
            $bookData['category_id'] = $categories->random()->id;
            Book::create($bookData);
        }

        $this->command->info('✅ Đã thêm dữ liệu mẫu cho bảng books!');
    }
}
