<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tắt kiểm tra khóa ngoại để tránh lỗi khi truncate bảng
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            TourSeeder::class,
            ImageSeeder::class,
            PromotionSeeder::class,
            BookingSeeder::class,
            CheckoutSeeder::class,
            ReviewSeeder::class,
        ]);

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
