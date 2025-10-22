<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'image_url')) {
                $table->string('image_url')->nullable()->after('description');
            }
            if (!Schema::hasColumn('books', 'image_path')) {
                $table->string('image_path')->nullable()->after('image_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'image_url')) {
                $table->dropColumn('image_url');
            }
            if (Schema::hasColumn('books', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }
};
