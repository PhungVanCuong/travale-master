<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblUser extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'userId';
    public $timestamps = false; // Sử dụng createdDate/updatedDate thủ công

    protected $fillable = ['username', 'password', 'email', 'phoneNumber', 'address', 'ipAddress', 'isActive', 'status', 'createdDate', 'updatedDate'];

    // Quan hệ 1-Nhiều với Booking
    public function bookings() {
        return $this->hasMany(TblBooking::class, 'userId', 'userId');
    }

    // Quan hệ 1-Nhiều với Review
    public function reviews() {
        return $this->hasMany(TblReview::class, 'userId', 'userId');
    }

    // Quan hệ 1-Nhiều với History
    public function history() {
        return $this->hasMany(TblHistory::class, 'userId', 'userId');
    }
}
