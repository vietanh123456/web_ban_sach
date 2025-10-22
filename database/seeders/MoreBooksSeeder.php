<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class MoreBooksSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo (hoặc lấy) vài danh mục mẫu
        $devCat   = Category::firstOrCreate(['name' => 'Lập trình']);
        $aiCat    = Category::firstOrCreate(['name' => 'Trí tuệ nhân tạo']);
        $english  = Category::firstOrCreate(['name' => 'Tiếng Anh']);

        $books = [
            [
                'title'       => 'Clean Code',
                'author'      => 'Robert C. Martin',
                'price'       => 150000,
                'description' => 'Nguyên tắc viết code dễ đọc, dễ bảo trì.',
                'category_id' => $devCat->id,
                'image_url'   => 'https://images-na.ssl-images-amazon.com/images/I/41xShlnTZTL._SX376_BO1,204,203,200_.jpg',
            ],
            [
                'title'       => 'Laravel Up & Running',
                'author'      => 'Matt Stauffer',
                'price'       => 180000,
                'description' => 'Sách thực chiến Laravel cho dev web.',
                'category_id' => $devCat->id,
                'image_url'   => 'https://mattstauffer.com/images/books/laravel-up-and-running-2e.jpg',
            ],
            [
                'title'       => 'Deep Learning',
                'author'      => 'Ian Goodfellow',
                'price'       => 320000,
                'description' => 'Giáo trình kinh điển về học sâu.',
                'category_id' => $aiCat->id,
                'image_url'   => 'https://images-na.ssl-images-amazon.com/images/I/51o4b5AdNLL._SX379_BO1,204,203,200_.jpg',
            ],
            [
                'title'       => 'Python Crash Course',
                'author'      => 'Eric Matthes',
                'price'       => 200000,
                'description' => 'Nhập môn Python qua dự án thực tế.',
                'category_id' => $devCat->id,
                'image_url'   => 'https://images-na.ssl-images-amazon.com/images/I/51F0xM2vhoL._SX379_BO1,204,203,200_.jpg',
            ],
            [
                'title'       => 'English Grammar in Use',
                'author'      => 'Raymond Murphy',
                'price'       => 190000,
                'description' => 'Ngữ pháp tiếng Anh cho trình độ trung cấp.',
                'category_id' => $english->id,
                'image_url'   => 'https://images-na.ssl-images-amazon.com/images/I/41YqJjJrCtL._SX376_BO1,204,203,200_.jpg',
            ],
        ];

        foreach ($books as $b) {
            Book::firstOrCreate(
                ['title' => $b['title'], 'author' => $b['author']],
                $b
            );
        }
    }
}
