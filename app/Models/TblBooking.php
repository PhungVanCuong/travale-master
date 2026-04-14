<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblBooking extends Model
{
    protected $table = 'tbl_booking';
    protected $primaryKey = 'bookingId';
    public $timestamps = false;

    protected $fillable = ['tourId', 'userId', 'bookingDate', 'numAdults', 'numChildren', 'totalPrice', 'paymentStatus', 'bookingStatus', 'specialRequests'];

    // Quan hệ thuộc về Tour
    public function tour() {
        return $this->belongsTo(TblTour::class, 'tourId', 'tourId');
    }

    // Quan hệ thuộc về User
    public function user() {
        return $this->belongsTo(TblUser::class, 'userId', 'userId');
    }

    // Quan hệ 1-1 với Invoice
    public function invoice() {
        return $this->hasOne(TblInvoice::class, 'bookingId', 'bookingId');
    }

    // Quan hệ 1-1 với Checkout
    public function checkout() {
        return $this->hasOne(TblCheckout::class, 'bookingId', 'bookingId');
    }
}
