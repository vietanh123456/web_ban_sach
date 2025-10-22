<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','author','price','description','category_id',
        'image_url',   // URL ngoài
        'image_path',  // đường dẫn tương đối: images/foo.jpg (ưu tiên)
        'image',       // legacy
    ];

    protected $casts = ['price' => 'integer'];
    protected $appends = ['cover_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getCoverUrlAttribute(): ?string
    {
        // 1) URL ngoài
        if (!empty($this->image_url)) {
            return $this->image_url;
        }

        // 2) Lấy chuỗi đường dẫn từ image_path (ưu tiên) hoặc image (legacy)
        $raw = $this->image_path ?: ($this->image ?? null);
        if (empty($raw)) {
            return null;
        }

        // Chuẩn hoá
        $path = ltrim($raw, '/');

        // 2a) Nếu đã là storage/... thì dùng luôn
        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        // 2b) Nếu là public/... thì render thẳng public/
        if (Str::startsWith($path, 'public/')) {
            return asset($path); // file nằm ở public/images/...
        }

        // 2c) Nếu là đường dẫn tương đối dưới disk public (images/...)
        // ưu tiên tìm trong storage/app/public
        if (Storage::disk('public')->exists($path)) {
            return asset('storage/'.$path);
        }

        // 2d) Nếu file đang nằm sẵn trong public/ (ví dụ images/foo.jpg)
        if (file_exists(public_path($path))) {
            return asset($path);
        }

        // Không tìm thấy
        return null;
    }
}
