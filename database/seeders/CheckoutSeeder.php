<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_checkout')->truncate();

        DB::table('tbl_checkout')->insert([
            ['checkoutId' => 1, 'bookingId' => 1, 'paymentMethod' => 'VNPAY', 'paymentDate' => Carbon::now()->subDays(30), 'amount' => 3350000, 'paymentStatus' => 'paid', 'transactionId' => 'VNP123456789'],
            ['checkoutId' => 2, 'bookingId' => 3, 'paymentMethod' => 'MOMO', 'paymentDate' => Carbon::now()->subDays(15), 'amount' => 24000000, 'paymentStatus' => 'paid', 'transactionId' => 'MM987654321'],
            ['checkoutId' => 3, 'bookingId' => 4, 'paymentMethod' => 'Credit Card', 'paymentDate' => Carbon::now()->subDays(10), 'amount' => 5600000, 'paymentStatus' => 'paid', 'transactionId' => 'CC112233445'],
            ['checkoutId' => 4, 'bookingId' => 6, 'paymentMethod' => 'VNPAY', 'paymentDate' => Carbon::now()->subDays(5), 'amount' => 2550000, 'paymentStatus' => 'paid', 'transactionId' => 'VNP556677889'],
        ]);
    }
}
