<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_reviews')->truncate();

        DB::table('tbl_reviews')->insert([
            ['reviewId' => 1, 'tourId' => 1, 'userId' => 16, 'rating' => 5, 'comment' => 'Tour Bà Nà rất tuyệt vời, HDV thân thiện, buffet ngon!', 'timestamp' => Carbon::now()->subDays(28)],
            ['reviewId' => 2, 'tourId' => 5, 'userId' => 18, 'rating' => 5, 'comment' => 'Khám phá văn hóa miền Trung cực kỳ thú vị, gia đình tôi rất hài lòng.', 'timestamp' => Carbon::now()->subDays(12)],
            ['reviewId' => 3, 'tourId' => 6, 'userId' => 19, 'rating' => 4, 'comment' => 'Đà Lạt hơi lạnh nhưng phong cảnh đẹp. Đồ ăn tạm ổn.', 'timestamp' => Carbon::now()->subDays(8)],
            ['reviewId' => 4, 'tourId' => 10, 'userId' => 16, 'rating' => 5, 'comment' => 'Tràng An nước trong vắt, đi thuyền rất chill.', 'timestamp' => Carbon::now()->subDays(2)],
        ]);
    }
}
