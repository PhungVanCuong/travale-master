<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TblAdmin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_admin';
    protected $primaryKey = 'adminId';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'email', 'role', 'createdDate'
    ];

    // Quan hệ 1-Nhiều với bảng Chat (1 admin có thể trả lời nhiều chat)
    public function chats() {
        return $this->hasMany(TblChat::class, 'adminId', 'adminId');
    }
}
