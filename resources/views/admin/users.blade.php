@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý Khách Hàng</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_panel">
                    <div class="x_content row">
                        @foreach ($users as $user)
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief">
                                            @if($user->isActive == 1) <span class="text-success">Hoạt động</span> @else <span class="text-danger">Đã khóa</span> @endif
                                        </h4>
                                        <div class="left col-md-7 col-sm-7">
                                            <h2>{{ $user->username }}</h2>
                                            <p><strong>Email: </strong> {{ $user->email }} </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-map-marker"></i> Đ/C: {{ $user->address ?? 'N/A' }}</li>
                                                <li><i class="fa fa-phone"></i> SĐT: {{ $user->phoneNumber }}</li>
                                            </ul>
                                        </div>
                                        <div class="right col-md-5 col-sm-5 text-center">
                                            <img src="{{ asset('admin/assets/images/user-profile/default.jpg') }}" alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class="profile-bottom text-center">
                                        <div class="col-sm-12 emphasis" style="display: flex; justify-content: end">

                                            @if ($user->isActive == 0)
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.active-user') }}"}' id="btn-active">
                                                    <i class="fa fa-check"> </i> Kích hoạt
                                                </button>
                                            @endif

                                            <button type="button" class="btn btn-warning btn-sm"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "b"}'
                                                id="btn-ban" style="{{ $user->status === 'b' ? 'display: none;' : '' }}">
                                                <i class="fa fa-ban"> </i> Khóa
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "active"}'
                                                id="btn-unban" style="{{ $user->status !== 'b' ? 'display: none;' : '' }}">
                                                <i class="fa fa-unlock"> </i> Mở Khóa
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "d"}'
                                                id="btn-delete" style="{{ $user->status === 'd' ? 'display: none;' : '' }}">
                                                <i class="fa fa-close"> </i> Xóa
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"
                                                data-attr='{"userId": "{{ $user->userId }}", "action": "{{ route('admin.status-user') }}", "status": "active"}'
                                                id="btn-restore" style="{{ $user->status !== 'd' ? 'display: none;' : '' }}">
                                                <i class="fa fa-refresh"> </i> Phục hồi
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@include('admin.blocks.footer')
