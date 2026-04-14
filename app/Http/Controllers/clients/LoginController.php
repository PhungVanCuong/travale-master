<?php

namespace App\Http\Controllers\clients;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\clients\Login;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class LoginController extends Controller
{
    private $login;
    protected $user;

    public function __construct()
    {
        $this->login = new Login();
        $this->user = new User();
    }

    public function index()
    {
        $title = 'Đăng nhập';
        return view('clients.login', compact('title'));
    }

    public function register(Request $request)
    {
        $username_regis = $request->username_regis;
        $email = $request->email;
        $password_regis = $request->password_regis;

        $checkAccountExist = $this->login->checkUserExist($username_regis, $email);
        if ($checkAccountExist) {
            return response()->json([
                'success' => false,
                'message' => 'Tên người dùng hoặc email đã tồn tại!'
            ]);
        }

        $activation_token = Str::random(60);
        $dataInsert = [
            'username'         => $username_regis,
            'email'            => $email,
            'password'         => md5($password_regis),
            'activation_token' => $activation_token,
            'isActive'         => 0, // 0 = Chưa kích hoạt
            'createdDate'      => Carbon::now()
        ];

        $this->login->registerAcount($dataInsert);
        $activation_link = route('activate', ['token' => $activation_token]);

        Mail::send('clients.mail.emails_activation', ['link' => $activation_link], function ($message) use ($email) {
            $message->to($email)->subject('Xác nhận kích hoạt tài khoản');
        });

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.',
        ]);
    }

    public function activate($token)
    {
        $user = $this->login->getUserByToken($token);

        if ($user) {
            $this->login->activateUserAccount($token);
            return redirect()->route('login')->with('success', 'Tài khoản của bạn đã được kích hoạt thành công!');
        } else {
            return redirect()->route('login')->with('error', 'Token kích hoạt không hợp lệ!');
        }
    }

    public function login(Request $request)
    {
        $login_id = $request->username_login; // Lấy dữ liệu từ input (chứa username hoặc email)
        $password = $request->password_login;

        // Trực tiếp nhận object User từ Model
        $user = $this->login->login($login_id, md5($password));

        if ($user != null) {
            if($user->isActive == 0){
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản chưa kích hoạt, vui lòng kiểm tra email!',
                ]);
            }
            if($user->status == 'b'){
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản đã bị khóa!',
                ]);
            }

            // Gán thông tin chuẩn từ Object $user vào Session, cho dù họ nhập bằng Email
            $request->session()->put('username', $user->username);
            $request->session()->put('userId', $user->userId);

            toastr()->success("Đăng nhập thành công!", 'Thông báo');
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công!',
                'redirectUrl' => route('home'),
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin tài khoản hoặc mật khẩu không chính xác!',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('username');
        $request->session()->forget('userId');
        toastr()->success("Đăng xuất thành công!", 'Thông báo');
        return redirect()->route('home');
    }
}
