<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblAdmin;

class LoginModel extends Model
{
    public function login($login_id, $pass){
        return TblAdmin::where(function($query) use ($login_id) {
            $query->where('username', $login_id)
                  ->orWhere('email', $login_id);
        })->where('password', $pass)->first();
    }
}
