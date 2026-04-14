<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblUser;

class UserModel extends Model
{
    public function getAllUsers() {
        return TblUser::all();
    }

    public function updateActive($id) {
        return TblUser::where('userId', $id)->update(['isActive' => 1]); // Theo SQL isActive là int (1)
    }

    public function changeStatus($id, $data){
        return TblUser::where('userId', $id)->update($data);
    }
}
