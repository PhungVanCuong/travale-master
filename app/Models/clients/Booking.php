<?php
namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblBooking;

class Booking extends Model
{
    public function createBooking($data) {
        $booking = TblBooking::create($data);
        return $booking->bookingId;
    }

    public function cancelBooking($bookingId){
        return TblBooking::where('bookingId', $bookingId)->update(['bookingStatus' => 'c']);
    }

    public function checkBooking($tourId, $userId) {
        return TblBooking::where('tourId', $tourId)
            ->where('userId', $userId)
            ->where('bookingStatus', 'f')
            ->exists();
    }
}
