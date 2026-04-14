<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $title = 'Thông tin cá nhân';
        $userId = $this->getUserId();
        $user = $this->user->getUser($userId);

        return view('clients.user-profile', compact('title', 'user'));
    }

    public function update(Request $req)
    {
        $address = $req->address;
        $email = $req->email;
        $phone = $req->phoneNumber; // Lấy theo biến name đã sửa ở file Blade

        $dataUpdate = [
            'address'     => $address,
            'email'       => $email,
            'phoneNumber' => $phone,
            'updatedDate' => Carbon::now()
        ];

        $userId = $this->getUserId();

        $update = $this->user->updateUser($userId, $dataUpdate);
        if (!$update) {
            return response()->json(['error' => true, 'message' => 'Bạn chưa thay đổi thông tin nào, vui lòng kiểm tra lại!']);
        }
        return response()->json(['success' => true, 'message' => 'Cập nhật thông tin thành công!']);
    }

    public function changePassword(Request $req)
    {
        $userId = $this->getUserId();
        $user = $this->user->getUser($userId);

        $oldPass = md5($req->oldPass);
        $newPass = md5($req->newPass);

        if ($user->password === $oldPass) {
            $update = $this->user->updateUser($userId, ['password' => $newPass, 'updatedDate' => Carbon::now()]);
            if ($update) {
                return response()->json(['success' => true, 'message' => 'Thay đổi mật khẩu thành công!']);
            }
        } else {
            return response()->json(['error' => true, 'message' => 'Mật khẩu cũ không chính xác.'], 500);
        }
    }

    public function changeAvatar(Request $req)
    {
        // Vì Bảng User mới của chúng ta không có cột avatar, mình sẽ lưu ảnh upload vào local
        // và set lại vào session để UI người dùng hiển thị ảnh mới mượt mà nhất.
        $req->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $avatar = $req->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();

        // Di chuyển ảnh vào thư mục public/admin/assets/images/user-profile/
        $avatar->move(public_path('admin/assets/images/user-profile'), $filename);

        // Cập nhật session
        $req->session()->put('avatar', $filename);

        return response()->json(['success' => true, 'message' => 'Cập nhật ảnh đại diện thành công!']);
    }
}
