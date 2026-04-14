<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_booking')->truncate();

        $bookings = [
            ['bookingId' => 1, 'tourId' => 1, 'userId' => 16, 'numAdults' => 2, 'numChildren' => 1, 'totalPrice' => 3350000, 'paymentStatus' => 'paid', 'bookingStatus' => 'f', 'specialRequests' => 'Ăn chay 1 suất'],
            ['bookingId' => 2, 'tourId' => 2, 'userId' => 17, 'numAdults' => 2, 'numChildren' => 0, 'totalPrice' => 7000000, 'paymentStatus' => 'unpaid', 'bookingStatus' => 'p', 'specialRequests' => 'Cần phòng view biển'],
            ['bookingId' => 3, 'tourId' => 5, 'userId' => 18, 'numAdults' => 4, 'numChildren' => 2, 'totalPrice' => 24000000, 'paymentStatus' => 'paid', 'bookingStatus' => 'f', 'specialRequests' => 'Hướng dẫn viên nói tiếng Anh'],
            ['bookingId' => 4, 'tourId' => 6, 'userId' => 19, 'numAdults' => 2, 'numChildren' => 0, 'totalPrice' => 5600000, 'paymentStatus' => 'paid', 'bookingStatus' => 'f', 'specialRequests' => 'Không có'],
            ['bookingId' => 5, 'tourId' => 8, 'userId' => 21, 'numAdults' => 1, 'numChildren' => 0, 'totalPrice' => 3200000, 'paymentStatus' => 'unpaid', 'bookingStatus' => 'c', 'specialRequests' => 'Hủy do bận việc'], // Đơn bị hủy
            ['bookingId' => 6, 'tourId' => 10, 'userId' => 16, 'numAdults' => 3, 'numChildren' => 0, 'totalPrice' => 2550000, 'paymentStatus' => 'paid', 'bookingStatus' => 'f', 'specialRequests' => ''],
        ];

        foreach ($bookings as &$b) {
            $b['bookingDate'] = Carbon::now()->subDays(rand(1, 40));
        }

        DB::table('tbl_booking')->insert($bookings);
    }
}
