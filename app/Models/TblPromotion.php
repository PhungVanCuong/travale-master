<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblPromotion extends Model
{
    protected $table = 'tbl_promotion';
    protected $primaryKey = 'promotionID';

    public $incrementing = false; // Tắt tự động tăng vì ID là chuỗi (String)
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'promotionID', 'description', 'discount', 'startDate', 'endDate', 'quantity'
    ];
}
