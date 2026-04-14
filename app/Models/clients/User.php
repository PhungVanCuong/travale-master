<?php
namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblUser;
use App\Models\TblBooking;

class User extends Model
{
    public function getUserId($username) {
        return TblUser::where('username', $username)->value('userId');
    }

    public function getUser($id) {
        return TblUser::find($id);
    }

    public function updateUser($id, $data) {
        return TblUser::where('userId', $id)->update($data);
    }

    public function getMyTours($id) {
        // Lấy danh sách booking của user, kèm thông tin tour, ảnh và reviews của user đó
        return TblBooking::with(['tour.images', 'checkout'])
            ->where('userId', $id)
            ->orderByDesc('bookingDate')
            ->take(3)->get()->map(function ($booking) use ($id) {
                $tour = $booking->tour;
                // Nhúng thêm rating do chính user này đánh giá
                $tour->user_rating = \App\Models\TblReview::where('tourId', $tour->tourId)
                                        ->where('userId', $id)->value('rating');
                return $tour;
            });
    }
}
