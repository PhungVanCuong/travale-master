<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Booking;
use App\Models\clients\Checkout;
use App\Models\clients\Tours;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class BookingController extends Controller
{
    private $tour;
    private $booking;
    private $checkout;
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->tour = new Tours();
        $this->booking = new Booking();
        $this->checkout = new Checkout();
        $this->user = new User();
    }

    public function index($id)
    {
        $title = 'Đặt Tour';
        $tour = $this->tour->getTourDetail($id);
        $transIdMomo = null;
        return view('clients.booking', compact('title', 'tour', 'transIdMomo'));
    }

    public function createBooking(Request $req)
    {
        $address = $req->input('address');
        $email = $req->input('email');
        $numAdults = $req->input('numAdults');
        $numChildren = $req->input('numChildren');
        $paymentMethod = $req->input('payment_hidden');
        $tel = $req->input('tel');
        $totalPrice = $req->input('totalPrice');
        $tourId = $req->input('tourId');
        $userId = $this->getUserId();

        // Update thông tin người dùng (SĐT, Địa chỉ)
        $dataUser = [
            'phoneNumber' => $tel,
            'address'     => $address,
            'updatedDate' => Carbon::now()
        ];
        $this->user->updateUser($userId, $dataUser);

        // Khởi tạo data Booking theo chuẩn bảng tbl_booking
        $dataBooking = [
            'tourId'        => $tourId,
            'userId'        => $userId,
            'bookingDate'   => Carbon::now(),
            'numAdults'     => $numAdults,
            'numChildren'   => $numChildren,
            'totalPrice'    => $totalPrice,
            'paymentStatus' => 'unpaid',
            'bookingStatus' => 'p', // p: pending
        ];

        $bookingId = $this->booking->createBooking($dataBooking);

        // Khởi tạo data Checkout theo chuẩn bảng tbl_checkout
        $dataCheckout = [
            'bookingId'     => $bookingId,
            'paymentMethod' => $paymentMethod,
            'amount'        => $totalPrice,
            'paymentStatus' => 'unpaid',
        ];

        $checkoutId = $this->checkout->createCheckout($dataCheckout);

        $title = 'Xác nhận hóa đơn';
        $tour_booked = $this->tour->tourBooked($bookingId, $checkoutId);

        return view('clients.tour-booked', compact('title', 'tour_booked', 'bookingId'));
    }

    public function cancelBooking(Request $req)
    {
        $bookingId = $req->bookingId;
        $cancelBooking = $this->booking->cancelBooking($bookingId);

        if ($cancelBooking) {
            toastr()->success("Hủy tour thành công!", 'Thông báo');
        } else {
            toastr()->error("Có lỗi xảy ra, thử lại sau!", 'Cảnh báo');
        }
        return redirect()->route('my-tours');
    }

    // Logic thanh toán MOMO giữ nguyên nguyên mẫu của bạn
    public function createMomoPayment(Request $request)
    {
        $amount = $request->input('amount');
        $tourId = $request->input('tourId');
        session()->put('tourId', $tourId);

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');

        $orderInfo = "Thanh toán qua MoMo";
        $orderId = time() . "";
        $redirectUrl = route('momo.callback');
        $ipnUrl = route('momo.callback');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        try {
            $response = Http::post($endpoint, $data);
            if ($response->successful()) {
                $responseData = $response->json();
                return response()->json(['payUrl' => $responseData['payUrl']]);
            } else {
                return response()->json(['error' => 'Lỗi kết nối với MoMo', 'details' => $response->body()], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function handlePaymentMomoCallback(Request $request)
    {
        $resultCode = $request->input('resultCode');
        $transIdMomo = $request->query('transId');

        $tourId = session()->get('tourId');
        $tour = $this->tour->getTourDetail($tourId);
        session()->forget('tourId');

        if ($resultCode == '0') {
            $title = 'Đã thanh toán';
            return view('clients.booking', compact('title', 'tour', 'transIdMomo'));
        } else {
            $title = 'Thanh toán thất bại';
            return view('clients.booking', compact('title', 'tour'));
        }
    }

    public function checkBooking(Request $req){
        $tourId = $req->tourId;
        $userId = $this->getUserId();
        $check = $this->booking->checkBooking($tourId, $userId);
        if (!$check) {
            return response()->json(['error' => 'Bạn phải hoàn thành chuyến đi để lại bình luận.'], 403);
        }
        return response()->json(['success' => 'OK']);
    }
}
