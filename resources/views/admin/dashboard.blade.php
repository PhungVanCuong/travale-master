@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="row" style="display: inline-block;width: 100%">
                <div class="tile_count">
                    <div class="col-md-3 col-sm-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-map"></i> Tours hoạt động</span>
                        <div class="count green">{{ $summary['tourWorking'] }}</div>
                    </div>
                    <div class="col-md-3 col-sm-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-shopping-cart"></i> Số lượng Booking</span>
                        <div class="count green">{{ $summary['countBooking'] }}</div>
                    </div>
                    <div class="col-md-3 col-sm-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Tổng Users</span>
                        <div class="count green">2,500</div>
                    </div>
                    <div class="col-md-3 col-sm-4 tile_stats_count">
                        <span class="count_top"><i class="fa fa-money"></i> Doanh thu</span>
                        <div class="count red">{{ number_format($summary['totalAmount'], 0, ',', '.') }} vnđ</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tours <small>đặt nhiều nhất</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Tour</th>
                                        <th>Chỗ đã đặt</th>
                                        <th>Sức chứa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newBooking as $item)
                                        <tr>
                                            <th scope="row"><a href="{{ route('admin.booking-detail',['id' => $item->bookingId]) }}">{{ $item->bookingId }}</a></th>
                                            <td>{{ $item->user->username ?? 'Khách' }}</td>
                                            <td>{{ $item->tour->title ?? 'N/A' }}</td>
                                            <td>{{ number_format($item->totalPrice, 0, ',', '.') }}</td>
                                            <td><span class="badge badge-warning">Chờ xác nhận</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Đơn đặt mới</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã HĐ</th>
                                        <th>Khách hàng</th>
                                        <th>Tên tours</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($newBooking as $item)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('admin.booking-detail',['id' => $item->bookingId]) }}">{{ $item->bookingId }}</a>
                                            </th>
                                            <td>{{ $item->user->username ?? 'N/A' }}</td>
                                            <td>{{ $item->tour->title ?? 'N/A' }}</td>
                                            <td>{{ number_format($item->totalPrice, 0, ',', '.') }} đ</td>
                                            <td><span class="badge badge-warning">Chờ xử lý</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Biểu đồ doanh thu 12 tháng</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <canvas id="lineChart" data-revenue-per-month="{{ json_encode($revenue) }}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@include('admin.blocks.footer')
