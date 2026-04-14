<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Liên hệ';
        return view('clients.contact', compact('title'));
    }

    public function createContact(Request $req)
    {
        $name = $req->name;
        $phone = $req->phone_number;
        $email = $req->email;
        $message = $req->message;

        // Lưu sđt vào thẳng message vì bảng mới ta làm gọn gàng hơn
        $dataContact = [
            'name'       => $name,
            'email'      => $email,
            'message'    => "SĐT: " . $phone . " - Nội dung: " . $message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $createContact = DB::table('tbl_contact')->insert($dataContact);

        if($createContact){
            toastr()->success('Gửi thành công. Chúng tôi sẽ sớm liên hệ tới bạn!');
        }else{
            toastr()->error('Có lỗi xảy ra. Xin vui lòng thử lại');
        }
        return redirect()->back();
    }
}
