<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travela - Đăng nhập Hệ Thống</title>
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="{{ asset('admin/assets/css/custom-css.css') }}" rel="stylesheet" />
</head>
<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="{{ route('admin.login-account') }}" method="POST" id="formLoginAdmin">
                        <h1>Trang Quản Trị</h1>
                        @csrf
                        <div>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Tài khoản hoặc Email (Admin)" required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu" required />
                        </div>
                        <div>
                            <button class="btn btn-default submit btn-success" style="color: white" type="submit">Đăng nhập</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
