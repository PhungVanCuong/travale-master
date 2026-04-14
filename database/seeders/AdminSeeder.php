<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_admin')->truncate();

        DB::table('tbl_admin')->insert([
            [
                'adminId' => 1,
                'username' => 'admin',
                'password' => '123456', // Mật khẩu chưa mã hóa để dễ dàng đăng nhập
                'email' => 'admin@travela.com',
                'role' => 'SuperAdmin',
                'createdDate' => Carbon::now()
            ],
            [
                'adminId' => 2,
                'username' => 'manager',
                'password' => '123456',
                'email' => 'manager@travela.com',
                'role' => 'Manager',
                'createdDate' => Carbon::now()
            ],
            [
                'adminId' => 3,
                'username' => 'editor',
                'password' => '123456',
                'email' => 'editor@travela.com',
                'role' => 'Editor',
                'createdDate' => Carbon::now()
            ]
        ]);
    }
}
