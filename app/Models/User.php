<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các cột có thể gán hàng loạt (mass assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // ✅ cột phân quyền
    ];

    /**
     * Các cột bị ẩn khi trả về JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kiểu dữ liệu cho các cột.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean', // ✅ Laravel sẽ tự ép kiểu true/false
    ];

    /**
     * Kiểm tra xem user có phải admin hay không.
     */
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin; // ép kiểu chắc chắn về boolean
    }
}
