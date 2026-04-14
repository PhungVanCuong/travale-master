<?php
namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblUser;

class Login extends Model
{
    public function registerAcount($data) {
        return TblUser::create($data);
    }

    public function checkUserExist($username, $email) {
        return TblUser::where('username', $username)->orWhere('email', $email)->exists();
    }

    public function getUserByToken($token) {
        return TblUser::where('activation_token', $token)->first();
    }

    public function activateUserAccount($token) {
        return TblUser::where('activation_token', $token)->update(['activation_token' => null, 'isActive' => 1]);
    }

    public function login($login_id, $password) {
        // Tìm user có username HOẶC email khớp với $login_id
        return TblUser::where(function($query) use ($login_id) {
            $query->where('username', $login_id)
                  ->orWhere('email', $login_id);
        })->where('password', $password)->first();
    }

    public function checkUserExistGoogle($google_id) {
        return TblUser::where('google_id', $google_id)->first();
    }
}
