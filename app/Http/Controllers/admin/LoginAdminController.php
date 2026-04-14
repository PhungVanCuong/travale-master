<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\LoginModel;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    private $login;

    public function __construct()
    {
        $this->login = new LoginModel();
    }

    public function index()
    {
        $title = 'Đăng nhập';
        return view('admin.login', compact('title'));
    }

    public function loginAdmin(Request $request)
    {
        $login_id = $request->username; // Tên input có thể là username hoặc email
        $password = md5($request->password);

        // Nhận lại đối tượng admin
        $admin = $this->login->login($login_id, $password);

        if ($admin !== null) {
            // Lưu username vào session (kể cả khi nhập email)
            $request->session()->put('admin', $admin->username);
            toastr()->success('Đăng nhập thành công');
            return redirect()->route('admin.dashboard');
        } else {
            toastr()->error('Thông tin đăng nhập không chính xác');
            return redirect()->route('admin.login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        toastr()->success("Đăng xuất thành công!", 'Thông báo');
        return redirect()->route('admin.login');
    }
}
