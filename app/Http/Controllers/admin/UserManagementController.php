<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\UserModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index()
    {
        $title = 'Quản lý người dùng';
        $users = $this->users->getAllUsers();

        return view('admin.users', compact('title', 'users'));
    }

    public function activeUser(Request $request)
    {
        $userId = $request->userId;

        // updateActive sẽ set isActive = 1 theo model mới
        $updateActive = $this->users->updateActive($userId);

        if ($updateActive) {
            return response()->json([
                'success' => true,
                'message' => 'Người dùng đã được kích hoạt thành công!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi kích hoạt người dùng!'
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        $userId = $request->userId;
        $status = $request->status; // Nhận biến status: 'active', 'b', 'd' từ View

        $dataUpdate = [
            'status' => $status
        ];

        $changeStatus = $this->users->changeStatus($userId, $dataUpdate);
        $statusText = $this->getStatusText($status);

        if ($changeStatus) {
            return response()->json([
                'success' => true,
                'status' => $statusText,
                'message' => "Trạng thái người dùng đã được cập nhật thành công!"
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Có lỗi xảy ra khi cập nhật trạng thái người dùng!"
            ], 500);
        }
    }

    private function getStatusText($status)
    {
        switch ($status) {
            case 'b':
                return 'Đã khóa';
            case 'd':
                return 'Đã xóa';
            case 'active':
                return 'Hoạt động';
            default:
                return 'Không xác định';
        }
    }
}
