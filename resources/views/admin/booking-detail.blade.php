@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Hóa đơn <small>đặt tour du lịch</small></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="invoice_booking">
                                <div class="x_title">
                                    <h2>Hóa đơn chi tiết</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <section class="content invoice">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="  invoice-header">
                                                <h3>
                                                    <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}" style="margin-right: 10px">
                                                    {{ $invoice_booking->tour->title ?? 'N/A' }}
                                                    <small class="pull-right">Ngày: {{ date('d-m-Y', strtotime($invoice_booking->bookingDate)) }}</small>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">Từ
                                                <address>
                                                    <strong>{{ $invoice_booking->user->username ?? 'Khách' }}</strong>
                                                    <br>{{ $invoice_booking->user->address ?? 'N/A' }}
                                                    <br>Số điện thoại: {{ $invoice_booking->user->phoneNumber ?? 'N/A' }}
                                                    <br>Email:{{ $invoice_booking->user->email ?? 'N/A' }}
                                                </address>
                                            </div>
                                            <div class="col-sm-4 invoice-col">Đến
                                                <address>
                                                    <strong>Công ty Travela</strong><br>470 Trần Đại Nghĩa<br>Ngũ Hành Sơn, Đà Nẵng
                                                    <br>Phone: 1 (804) 123-9876<br>Email: minhdien.dev@gmail.com
                                                </address>
                                            </div>
                                            <div class="col-sm-4 invoice-col">
                                                <b>Mã hóa đơn #{{ $invoice_booking->checkout->checkoutId ?? 'N/A' }}</b><br><br>
                                                <b>Mã giao dịch:</b> {{ $invoice_booking->checkout->transactionId ?? 'N/A' }}<br>
                                                <b>Ngày thanh toán:</b> {{ $invoice_booking->checkout->paymentDate ?? 'Chưa thanh toán' }}<br>
                                                <b>Tài khoản:</b> {{ $invoice_booking->userId }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th></th><th>Số lượng</th><th>Đơn giá</th><th>Điểm đến</th><th>Tổng tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Người lớn</td>
                                                            <td>{{ $invoice_booking->numAdults }}</td>
                                                            <td>{{ number_format($invoice_booking->tour->priceAdult, 0, ',', '.') }} vnđ</td>
                                                            <td>{{ $invoice_booking->tour->destination }}</td>
                                                            <td>{{ number_format($invoice_booking->tour->priceAdult * $invoice_booking->numAdults, 0, ',', '.') }} vnđ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trẻ em</td>
                                                            <td>{{ $invoice_booking->numChildren }}</td>
                                                            <td>{{ number_format($invoice_booking->tour->priceChild, 0, ',', '.') }} vnđ</td>
                                                            <td>{{ $invoice_booking->tour->destination }}</td>
                                                            <td>{{ number_format($invoice_booking->tour->priceChild * $invoice_booking->numChildren, 0, ',', '.') }} vnđ</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="lead">Phương thức thanh toán:</p>
                                                @if (isset($invoice_booking->checkout) && $invoice_booking->checkout->paymentMethod == 'MOMO')
                                                    <img src="{{ asset('admin/assets/images/icon/icon_momo.png') }}" class="invoice_payment-method" alt="">
                                                @elseif (isset($invoice_booking->checkout) && $invoice_booking->checkout->paymentMethod == 'VNPAY')
                                                    <img src="{{ asset('admin/assets/images/icon/icon_vnpay.png') }}" class="invoice_payment-method" alt="">
                                                @else
                                                    <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}" alt="">
                                                    <span class="badge badge-info">Thanh toán tại văn phòng</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p class="lead">Số tiền phải trả trước {{ date('d-m-Y', strtotime($invoice_booking->tour->startDate)) }}</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Tổng tiền:</th>
                                                                <td>{{ number_format($invoice_booking->totalPrice, 0, ',', '.') }} vnđ</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tổng (Checkout):</th>
                                                                <td>{{ number_format($invoice_booking->checkout->amount ?? $invoice_booking->totalPrice, 0, ',', '.') }} vnđ</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->


                                    </section>
                                </div>
                            </div>
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class=" ">
                                    <button class="btn btn-default" onclick="window.print();"><i
                                            class="fa fa-print"></i> Print</button>
                                    <button id="send-pdf-btn" data-bookingid= "{{ $invoice_booking->bookingId }}"
                                        data-email={{ $invoice_booking->email }}
                                        data-urlSendMail={{ route('admin.send.pdf') }}
                                        class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                            class="fa fa-send"></i> Gửi hóa đơn cho khách hàng</button>
                                    @if ($invoice_booking->bookingStatus == 'b')
                                        <button class="btn btn-success pull-right confirm-booking"
                                            data-bookingId="{{ $invoice_booking->bookingId }}"
                                            data-urlConfirm="{{ route('admin.confirm-booking') }}"><i
                                                class="fa fa-credit-card"></i> Xác nhận</button>
                                    @endif
                                    <button id="received-money" data-bookingid= "{{ $invoice_booking->bookingId }}"
                                         data-urlPaid="{{ route('admin.received') }}"
                                        class="btn btn-info pull-right {{ $hide }}" style="margin-right: 5px;"><i
                                            class="glyphicon glyphicon-usd"></i> Đã thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
@include('admin.blocks.footer')
