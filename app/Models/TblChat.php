<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblChat extends Model
{
    protected $table = 'tbl_chat';
    protected $primaryKey = 'chatID';
    public $timestamps = false;

    protected $fillable = [
        'userId', 'adminId', 'messages', 'readStatus', 'createdDate', 'ipAddress'
    ];

    public function user() {
        return $this->belongsTo(TblUser::class, 'userId', 'userId');
    }

    public function admin() {
        return $this->belongsTo(TblAdmin::class, 'adminId', 'adminId');
    }
}
