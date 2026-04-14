@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Thông tin tài khoản Admin</h3>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_content">
                                <div class="col-md-3 col-sm-3 profile_left">
                                    <div class="profile_img">
                                        <div id="crop-avatar">
                                            <img id="avatarAdminPreview" class="img-responsive avatar-view"
                                                src="{{ asset('admin/assets/images/user-profile/avt_admin.jpg') }}"
                                                alt="Avatar" style="width:100%" title="Đổi ảnh đại diện">
                                        </div>
                                    </div>
                                    <h3 id="nameAdmin" style="text-align: center; margin-top: 20px;">{{ $admin->username }}</h3>
                                    <ul class="list-unstyled user_data" style="text-align: center">
                                        <li><i class="fa fa-envelope user-profile-icon"></i> {{ $admin->email }}</li>
                                        <li><i class="fa fa-briefcase user-profile-icon"></i> Role: {{ $admin->role }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-9 ">
                                    <form action="{{ route('admin.update-admin') }}" id="formProfileAdmin" class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Tên đăng nhập <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="username" name="username" required class="form-control" value="{{ $admin->username }}" disabled>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Mật khẩu mới</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Bỏ trống nếu không muốn đổi">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                                            <div class="col-md-6 col-sm-6">
                                                <input id="email" class="form-control" type="email" name="email" required value="{{ $admin->email }}">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button type="submit" class="btn btn-success">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@include('admin.blocks.footer')
