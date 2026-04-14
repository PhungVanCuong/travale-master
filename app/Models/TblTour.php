<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblTour extends Model
{
    protected $table = 'tbl_tours';
    protected $primaryKey = 'tourId';
    public $timestamps = false;

    protected $fillable = ['title', 'description', 'quantity', 'priceAdult', 'priceChild', 'destination', 'domain', 'availability', 'time', 'startDate', 'endDate'];

    public function images() {
        return $this->hasMany(TblImage::class, 'tourId', 'tourId');
    }

    public function bookings() {
        return $this->hasMany(TblBooking::class, 'tourId', 'tourId');
    }

    public function reviews() {
        return $this->hasMany(TblReview::class, 'tourId', 'tourId');
    }
}
