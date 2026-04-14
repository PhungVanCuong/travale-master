<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblBooking;
use App\Models\TblCheckout;

class BookingModel extends Model
{
    public function getBooking(){
        // Sử dụng Eager Loading để lấy sẵn tour và checkout (Không cần JOIN thủ công)
        return TblBooking::with(['tour', 'checkout'])->orderByDesc('bookingDate')->get();
    }

    public function updateBooking($bookingId, $data){
        return TblBooking::where('bookingId', $bookingId)->update($data);
    }

    public function getInvoiceBooking($bookingId){
        return TblBooking::with(['tour', 'checkout'])->where('bookingId', $bookingId)->first();
    }

    public function updateCheckout($bookingId, $data){
        return TblCheckout::where('bookingId', $bookingId)->update($data);
    }
}
