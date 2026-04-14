<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblCheckout extends Model
{
    protected $table = 'tbl_checkout';
    protected $primaryKey = 'checkoutId';
    public $timestamps = false;

    protected $fillable = [
        'bookingId', 'paymentMethod', 'paymentDate', 'amount', 'paymentStatus', 'transactionId'
    ];

    // Thanh toán này thuộc về Booking nào
    public function booking() {
        return $this->belongsTo(TblBooking::class, 'bookingId', 'bookingId');
    }
}
