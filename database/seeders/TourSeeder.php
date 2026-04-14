<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_tours')->truncate();

        DB::table('tbl_tours')->insert([
            ['tourId' => 1, 'title' => 'Tour Bà Nà Hills Trọn Gói', 'description' => 'Khám phá Cầu Vàng, Làng Pháp và Fantasy Park với hệ thống cáp treo đạt kỷ lục Guinness.', 'quantity' => 50, 'priceAdult' => 1250000, 'priceChild' => 850000, 'destination' => 'Đà Nẵng', 'domain' => 't', 'availability' => 1, 'time' => '1 Ngày', 'startDate' => '2026-05-01', 'endDate' => '2026-12-31'],
            ['tourId' => 2, 'title' => 'Khám phá Vịnh Hạ Long', 'description' => 'Nghỉ dưỡng trên du thuyền 5 sao, chèo thuyền Kayak và thăm quan hang Sửng Sốt.', 'quantity' => 30, 'priceAdult' => 3500000, 'priceChild' => 2000000, 'destination' => 'Quảng Ninh', 'domain' => 'b', 'availability' => 1, 'time' => '2 Ngày 1 Đêm', 'startDate' => '2026-05-10', 'endDate' => '2026-12-31'],
            ['tourId' => 3, 'title' => 'Tour 4 Đảo Phú Quốc', 'description' => 'Ngắm san hô, lặn biển và đi cáp treo Hòn Thơm vượt biển dài nhất thế giới.', 'quantity' => 40, 'priceAdult' => 1500000, 'priceChild' => 1000000, 'destination' => 'Kiên Giang', 'domain' => 'n', 'availability' => 1, 'time' => '1 Ngày', 'startDate' => '2026-06-01', 'endDate' => '2026-12-31'],
            ['tourId' => 4, 'title' => 'Săn Mây Tà Xùa - Mộc Châu', 'description' => 'Trải nghiệm thiên nhiên Tây Bắc hùng vĩ, sống lưng khủng long và đồi chè trái tim.', 'quantity' => 20, 'priceAdult' => 2200000, 'priceChild' => 1500000, 'destination' => 'Sơn La', 'domain' => 'b', 'availability' => 1, 'time' => '3 Ngày 2 Đêm', 'startDate' => '2026-09-01', 'endDate' => '2026-11-30'],
            ['tourId' => 5, 'title' => 'Hành trình di sản Miền Trung', 'description' => 'Tham quan Đại Nội Huế, Phố cổ Hội An và Thánh địa Mỹ Sơn.', 'quantity' => 45, 'priceAdult' => 4500000, 'priceChild' => 3000000, 'destination' => 'Huế - Quảng Nam', 'domain' => 't', 'availability' => 1, 'time' => '4 Ngày 3 Đêm', 'startDate' => '2026-07-01', 'endDate' => '2026-12-31'],
            ['tourId' => 6, 'title' => 'Nghỉ Dưỡng Đà Lạt Ngàn Hoa', 'description' => 'Thăm Thung lũng tình yêu, đỉnh Langbiang và thưởng thức cafe chồn.', 'quantity' => 35, 'priceAdult' => 2800000, 'priceChild' => 1800000, 'destination' => 'Lâm Đồng', 'domain' => 't', 'availability' => 1, 'time' => '3 Ngày 2 Đêm', 'startDate' => '2026-05-15', 'endDate' => '2026-12-31'],
            ['tourId' => 7, 'title' => 'Chợ nổi Cái Răng - Miền Tây', 'description' => 'Khám phá văn hóa miệt vườn, nghe đờn ca tài tử và hái trái cây tại vườn.', 'quantity' => 50, 'priceAdult' => 1100000, 'priceChild' => 700000, 'destination' => 'Cần Thơ', 'domain' => 'n', 'availability' => 1, 'time' => '2 Ngày 1 Đêm', 'startDate' => '2026-06-10', 'endDate' => '2026-12-31'],
            ['tourId' => 8, 'title' => 'Chinh phục đỉnh Fansipan', 'description' => 'Leo núi hoặc đi cáp treo lên nóc nhà Đông Dương, thăm bản Cát Cát.', 'quantity' => 25, 'priceAdult' => 3200000, 'priceChild' => 2100000, 'destination' => 'Lào Cai', 'domain' => 'b', 'availability' => 1, 'time' => '3 Ngày 2 Đêm', 'startDate' => '2026-08-01', 'endDate' => '2026-12-31'],
            ['tourId' => 9, 'title' => 'Lặn ngắm san hô Nha Trang', 'description' => 'Tour VIP 3 đảo bằng cano cao tốc, tắm bùn khoáng nóng Hòn Tằm.', 'quantity' => 60, 'priceAdult' => 950000, 'priceChild' => 600000, 'destination' => 'Khánh Hòa', 'domain' => 't', 'availability' => 1, 'time' => '1 Ngày', 'startDate' => '2026-05-20', 'endDate' => '2026-12-31'],
            ['tourId' => 10, 'title' => 'Tràng An - Bái Đính', 'description' => 'Du thuyền khám phá quần thể di sản thế giới Tràng An, lễ Phật chùa Bái Đính.', 'quantity' => 50, 'priceAdult' => 850000, 'priceChild' => 500000, 'destination' => 'Ninh Bình', 'domain' => 'b', 'availability' => 1, 'time' => '1 Ngày', 'startDate' => '2026-06-01', 'endDate' => '2026-12-31'],
        ]);
    }
}
