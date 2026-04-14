<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $title = 'Quản lý Admin';
        $admin = $this->admin->getAdmin();

        return view('admin.profile-admin', compact('title', 'admin'));
    }

    public function updateAdmin(Request $request)
    {
        // Nhận dữ liệu từ form (blade đã sửa)
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;

        $admin = $this->admin->getAdmin();
        $oldPass = $admin->password;

        if (!empty($password) && $password != $oldPass) {
            $password = md5($password);
        } else {
            $password = $oldPass; // Nếu không nhập mk mới thì giữ nguyên
        }

        $dataUpdate = [
            'username' => $username,
            'password' => $password,
            'email' => $email
        ];

        $update = $this->admin->updateAdmin($dataUpdate);
        $newinfo = $this->admin->getAdmin();

        if ($update) {
            return response()->json([
                'success' => true,
                'data' => $newinfo
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Không có thông tin nào thay đổi!']);
        }
    }

    public function updateAvatar(Request $req)
    {
        $avatar = $req->file('avatarAdmin');

        // Tạo tên mới cho tệp ảnh (Ghi đè luôn avatar mặc định)
        $filename = 'avt_admin.jpg';
        $oldPath = public_path('admin/assets/images/user-profile/avt_admin.jpg');

        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        // Di chuyển ảnh vào thư mục
        $update = $avatar->move(public_path('admin/assets/images/user-profile'), $filename);

        if (!$update) {
            return response()->json(['error' => true, 'message' => 'Có vấn đề khi cập nhật ảnh!']);
        }
        return response()->json(['success' => true, 'message' => 'Cập nhật ảnh đại diện thành công!']);
    }
}
