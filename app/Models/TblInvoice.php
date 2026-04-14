<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblInvoice extends Model
{
    protected $table = 'tbl_invoice';
    protected $primaryKey = 'invoiceId';
    public $timestamps = false;

    protected $fillable = [
        'bookingId', 'amount', 'dateIssued', 'details'
    ];

    // Hóa đơn này thuộc về Booking nào
    public function booking() {
        return $this->belongsTo(TblBooking::class, 'bookingId', 'bookingId');
    }
}
