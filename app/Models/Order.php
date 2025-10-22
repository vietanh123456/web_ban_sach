<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'customer_name',
        'customer_phone',
        'customer_addr',
        'note',
        // Nếu DB còn cột này thì để đây cũng không sao;
        // nếu DB không có cột, Laravel sẽ không dùng tới.
        'total_price',
    ];

    // Quan hệ
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tiện ích
    public function getItemsCountAttribute(): int
    {
        return (int) $this->items->sum('quantity');
    }

    public function getFormattedTotalAttribute(): string
    {
        // Ưu tiên total_amount; fallback sang total_price nếu cần
        $total = $this->total_amount ?? $this->total_price ?? 0;

        return number_format((int) $total, 0, ',', '.');
    }

    // Scope lọc theo user
    public function scopeOfUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}
