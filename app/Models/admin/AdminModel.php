<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblAdmin;

class AdminModel extends Model
{
    public function getAdmin(){
        return TblAdmin::first();
    }

    public function updateAdmin($data){
        return TblAdmin::where('username', 'admin')->update($data);
    }
}
