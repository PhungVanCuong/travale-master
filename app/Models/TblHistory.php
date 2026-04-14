<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblHistory extends Model
{
    protected $table = 'tbl_history';
    protected $primaryKey = 'historyId';
    public $timestamps = false;

    protected $fillable = [
        'userId', 'tourId', 'actionType', 'timestamp'
    ];

    // Thuộc về User nào
    public function user() {
        return $this->belongsTo(TblUser::class, 'userId', 'userId');
    }

    // Thuộc về Tour nào (có thể null nếu action không liên quan tour)
    public function tour() {
        return $this->belongsTo(TblTour::class, 'tourId', 'tourId');
    }
}
