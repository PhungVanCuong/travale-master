<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_users')->truncate();

        $users = [
            ['userId' => 16, 'username' => 'nguyendv', 'password' => '123456', 'email' => 'dien@gmail.com', 'phoneNumber' => '0967468703', 'address' => 'Đà Nẵng', 'isActive' => 1],
            ['userId' => 17, 'username' => 'khachhang1', 'password' => '123456', 'email' => 'khachhang1@gmail.com', 'phoneNumber' => '0901234567', 'address' => 'Hà Nội', 'isActive' => 1],
            ['userId' => 18, 'username' => 'khachhang2', 'password' => '123456', 'email' => 'khachhang2@gmail.com', 'phoneNumber' => '0912345678', 'address' => 'Hồ Chí Minh', 'isActive' => 1],
            ['userId' => 19, 'username' => 'tranvanb', 'password' => '123456', 'email' => 'tranb@gmail.com', 'phoneNumber' => '0987654321', 'address' => 'Cần Thơ', 'isActive' => 1],
            ['userId' => 20, 'username' => 'lethic', 'password' => '123456', 'email' => 'lec@gmail.com', 'phoneNumber' => '0933445566', 'address' => 'Hải Phòng', 'isActive' => 0], // Inactive user để test
            ['userId' => 21, 'username' => 'hoangd', 'password' => '123456', 'email' => 'hoangd@gmail.com', 'phoneNumber' => '0977889900', 'address' => 'Huế', 'isActive' => 1],
        ];

        foreach ($users as &$user) {
            $user['ipAddress'] = '127.0.0.1';
            $user['status'] = 'active';
            $user['createdDate'] = Carbon::now()->subDays(rand(1, 30));
        }

        DB::table('tbl_users')->insert($users);
    }
}
