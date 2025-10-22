<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Chỉ thêm cột nếu chưa có (tránh duplicate)
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'total_amount')) {
                $table->unsignedBigInteger('total_amount')->default(0);
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status', 20)->default('pending');
            }
            if (!Schema::hasColumn('orders', 'customer_name')) {
                $table->string('customer_name', 255)->nullable();
            }
            if (!Schema::hasColumn('orders', 'customer_phone')) {
                $table->string('customer_phone', 50)->nullable();
            }
            if (!Schema::hasColumn('orders', 'customer_addr')) {
                $table->string('customer_addr', 500)->nullable();
            }
            if (!Schema::hasColumn('orders', 'note')) {
                $table->text('note')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Chỉ drop những cột đang tồn tại
        $cols = [];
        foreach (['total_amount','status','customer_name','customer_phone','customer_addr','note'] as $c) {
            if (Schema::hasColumn('orders', $c)) {
                $cols[] = $c;
            }
        }

        if (!empty($cols)) {
            Schema::table('orders', function (Blueprint $table) use ($cols) {
                // Nếu bạn dùng SQLite và gặp lỗi dropColumn, cài thêm doctrine/dbal hoặc bỏ qua down() trong môi trường dev
                $table->dropColumn($cols);
            });
        }
    }
};
