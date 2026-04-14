<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\BookingModel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingManagementController extends Controller
{
    private $booking;

    public function __construct()
    {
        $this->booking = new BookingModel();
    }

    public function index()
    {
        $title = 'Quản lý đặt Tour';

        $list_booking = $this->booking->getBooking();
        $list_booking = $this->updateHideBooking($list_booking);

        return view('admin.booking', compact('title', 'list_booking'));
    }

    public function confirmBooking(Request $request)
    {
        $bookingId = $request->bookingId;

        $dataConfirm = [
            'bookingStatus' => 'y' // Trạng thái 'y' cho Đã xác nhận
        ];

        $result = $this->booking->updateBooking($bookingId, $dataConfirm);

        if ($result) {
            $list_booking = $this->booking->getBooking();
            $list_booking = $this->updateHideBooking($list_booking);
            return response()->json([
                'success' => true,
                'message' => 'Xác nhận đơn thành công.',
                'data' => view('admin.partials.list-booking', compact('list_booking'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Xác nhận thất bại.'
            ], 500);
        }
    }

    public function finishBooking(Request $request)
    {
        $bookingId = $request->bookingId;

        $dataConfirm = [
            'bookingStatus' => 'f' // Trạng thái 'f' cho Hoàn thành
        ];

        $result = $this->booking->updateBooking($bookingId, $dataConfirm);

        if ($result) {
            $list_booking = $this->booking->getBooking();
            $list_booking = $this->updateHideBooking($list_booking);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái Hoàn Thành thành công.',
                'data' => view('admin.partials.list-booking', compact('list_booking'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật thất bại.'
            ], 500);
        }
    }

    public function receiviedMoney(Request $request)
    {
        $bookingId = $request->bookingId;

        $dataUpdate = [
            'paymentStatus' => 'paid' // DB gốc là chữ paid
        ];

        $result = $this->booking->updateCheckout($bookingId, $dataUpdate);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Xác nhận đã thu tiền thành công.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật thất bại.'
            ], 500);
        }
    }

    private function updateHideBooking($list_booking)
    {
        $currentDate = date('Y-m-d');

        foreach ($list_booking as $booking) {
            // Lấy endDate qua relationship Tour
            if ($booking->tour && $booking->tour->endDate < $currentDate) {
                $hide = '';
            } else {
                $hide = 'hide';
            }
            $booking->hide = $hide;
        }

        return $list_booking;
    }

    public function bookingDetail($id)
    {
        $title = 'Chi tiết hóa đơn';
        $invoice_booking = $this->booking->getInvoiceBooking($id);

        if ($invoice_booking && $invoice_booking->tour && $invoice_booking->tour->endDate < date('Y-m-d')) {
            $hide = '';
        } else {
            $hide = 'hide';
        }

        return view('admin.booking-detail', compact('title', 'invoice_booking', 'hide'));
    }

    public function sendPdf(Request $request)
    {
        $bookingId = $request->bookingId;
        $email = $request->email;

        $invoice_booking = $this->booking->getInvoiceBooking($bookingId);

        $pdf = PDF::loadView('admin.emails.invoice', compact('invoice_booking'));

        try {
            Mail::send('admin.emails.invoice', compact('invoice_booking'), function ($message) use ($email, $pdf, $invoice_booking) {
                $message->to($email)
                        ->subject('Hóa đơn đặt Tour #' . $invoice_booking->bookingId)
                        ->attachData($pdf->output(), 'Hoa_don_Travela.pdf');
            });

            return response()->json(['success' => true, 'message' => 'Email đã được gửi thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi khi gửi email: ' . $e->getMessage()]);
        }
    }
}
