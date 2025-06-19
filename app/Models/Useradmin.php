<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Useradmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Định nghĩa bảng được liên kết với mô hình
    protected $table = 'users';

    /**
     * Các thuộc tính có thể gán hàng loạt.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'full_name', 'phone', 'address', 'remember_token',
    ];

    /**
     * Các thuộc tính cần ẩn cho mảng.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Các thuộc tính cần chuyển đổi sang kiểu dữ liệu gốc.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Kiểm tra nếu người dùng có vai trò admin.
     *
     * @return bool
     */
    
}
?>