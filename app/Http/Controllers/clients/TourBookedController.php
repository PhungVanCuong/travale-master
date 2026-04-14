<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Booking;
use App\Models\clients\Tours;
use App\Models\TblBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TourBookedController extends Controller
{
    private $tour;
    private $booking;

    public function __construct()
    {
        $this->tour = new Tours();
        $this->booking = new Booking();
    }

    public function index(Request $req)
    {
        $title = "Tour đã đặt";

        $bookingId = $req->input('bookingId');

        // Sử dụng Eloquent để lấy đầy đủ các quan hệ
        $tour_booked = TblBooking::with(['tour', 'user', 'checkout'])
                        ->where('bookingId', $bookingId)
                        ->first();

        if ($tour_booked && $tour_booked->tour && $tour_booked->tour->startDate) {
            $today = Carbon::now();
            $startDate = Carbon::parse($tour_booked->tour->startDate);

            // Tính toán sự chênh lệch. Nếu < 7 ngày sẽ ẩn nút Hủy Tour
            $diffInDays = $startDate->diffInDays($today, false);

            // diffInDays có thể âm nếu ngày start chưa tới, tính khoảng cách tuyệt đối
            $absoluteDiff = $today->diffInDays($startDate);
            $hide = ($startDate->greaterThan($today) && $absoluteDiff < 7) ? 'hide' : '';
        } else {
            $hide = '';
        }

        return view("clients.tour-booked", compact('title', 'tour_booked', 'hide', 'bookingId'));
    }

    public function cancelBooking(Request $req)
    {
        $tourId = $req->tourId;
        $quantityAdults = $req->quantity__adults;
        $quantityChildren = $req->quantity__children;
        $bookingId = $req->bookingId;

        $tour = $this->tour->getTourDetail($tourId);
        $currentQuantity = $tour->quantity;

        // Tính toán số lượng trả lại
        $return_quantity = $quantityAdults + $quantityChildren;

        // Cập nhật lại số lượng mới cho tour
        $newQuantity = $currentQuantity + $return_quantity;
        $updateQuantity = $this->tour->updateTours($tourId, ['quantity' => $newQuantity]);

        // Hủy booking (sẽ cập nhật bookingStatus = 'c')
        $updateBooking = $this->booking->cancelBooking($bookingId);

        if ($updateQuantity && $updateBooking) {
            toastr()->success('Hủy thành công!', 'Thông báo');
        } else {
            toastr()->error('Có lỗi xảy ra !', 'Thông báo');
        }

        return redirect()->route('my-tours');
    }
}
