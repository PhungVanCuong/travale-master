<?php

namespace App\Http\Controllers;

use App\Models\clients\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    public function __construct()
    {
        // Khởi tạo Model User (đã được viết lại bằng Eloquent ở thư mục clients)
        $this->user = new User();
    }

    /**
     * Hàm dùng chung để lấy userId từ Session hiện tại
     * Nếu chưa có trong session nhưng đã đăng nhập (có username), sẽ tự động query DB để lấy và lưu lại.
     */
    protected function getUserId()
    {
        if (!session()->has('userId')) {
            $username = session()->get('username');
            if ($username) {
                // Gọi hàm getUserId từ Model clients\User.php
                $userId = $this->user->getUserId($username);

                if ($userId) {
                    session()->put('userId', $userId);
                }
            }
        }

        return session()->get('userId');
    }
}
