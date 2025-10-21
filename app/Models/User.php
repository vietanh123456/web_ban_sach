<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các cột cho phép gán hàng loạt
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * Giá trị mặc định cho thuộc tính (tránh null)
     */
    protected $attributes = [
        'is_admin' => false,
    ];

    /**
     * Ẩn khi trả về JSON/array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Ép kiểu
     * - 'password' => 'hashed' yêu cầu Laravel 10+ (tự hash khi set)
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_admin'          => 'boolean',
    ];

    /**
     * Kiểm tra quyền admin
     */
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    /**
     * Scope: chỉ admin
     */
    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    /**
     * Accessor gợi ý: tên hiển thị
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: explode('@', (string) $this->email)[0];
    }
}
