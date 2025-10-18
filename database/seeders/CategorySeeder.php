<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Tiểu thuyết'],
            ['name' => 'Kinh tế'],
            ['name' => 'Thiếu nhi'],
            ['name' => 'Lịch sử'],
            ['name' => 'Khoa học'],
        ]);
    }
}
