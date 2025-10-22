<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'price',
        'quantity',
    ];

    // --- Quan hệ ---
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // --- Tiện ích ---
    public function getLineTotalAttribute(): int
    {
        return (int) $this->price * (int) $this->quantity;
    }

    public function getFormattedLineTotalAttribute(): string
    {
        return number_format($this->line_total, 0, ',', '.');
    }
}
