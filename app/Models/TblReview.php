<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblReview extends Model
{
    protected $table = 'tbl_reviews';
    protected $primaryKey = 'reviewId';
    public $timestamps = false;

    protected $fillable = ['tourId', 'userId', 'rating', 'comment', 'timestamp'];

    public function tour() {
        return $this->belongsTo(TblTour::class, 'tourId', 'tourId');
    }

    public function user() {
        return $this->belongsTo(TblUser::class, 'userId', 'userId');
    }
}
