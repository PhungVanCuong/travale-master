<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_promotion')->truncate();

        DB::table('tbl_promotion')->insert([
            ['promotionID' => 'SUMMER2026', 'description' => 'Giảm giá mùa hè rực rỡ', 'discount' => 500000, 'startDate' => '2026-05-01', 'endDate' => '2026-08-31', 'quantity' => 100],
            ['promotionID' => 'WELCOME', 'description' => 'Chào mừng khách mới đăng ký', 'discount' => 100000, 'startDate' => '2026-01-01', 'endDate' => '2026-12-31', 'quantity' => 999],
            ['promotionID' => 'VIPTOUR', 'description' => 'Giảm sâu cho tour cao cấp', 'discount' => 1000000, 'startDate' => '2026-06-01', 'endDate' => '2026-12-31', 'quantity' => 50],
            ['promotionID' => 'FLASH_SALE', 'description' => 'Sale chớp nhoáng cuối tuần', 'discount' => 200000, 'startDate' => '2026-04-10', 'endDate' => '2026-04-30', 'quantity' => 200],
        ]);
    }
}
