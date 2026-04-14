@foreach ($list_booking as $booking)
    <tr>
        <td>{{ $booking->tour->title ?? 'N/A' }}</td>
        <td>{{ $booking->user->username ?? 'N/A' }}</td>
        <td>{{ $booking->user->email ?? 'N/A' }}</td>
        <td>{{ $booking->user->phoneNumber ?? 'N/A' }}</td>
        <td>{{ $booking->user->address ?? 'N/A' }}</td>
        <td>{{ date('d-m-Y', strtotime($booking->bookingDate)) }}</td>
        <td>{{ $booking->numAdults }}</td>
        <td>{{ $booking->numChildren }}</td>
        <td>{{ number_format($booking->totalPrice, 0, ',', '.') }}</td>
        <td>
            @if ($booking->bookingStatus == 'c') <span class="badge badge-danger">Đã hủy</span>
            @elseif ($booking->bookingStatus == 'p') <span class="badge badge-warning">Chờ xác nhận</span>
            @elseif ($booking->bookingStatus == 'f') <span class="badge badge-success">Hoàn thành</span>
            @endif
        </td>
        <td>
            @if (isset($booking->checkout) && $booking->checkout->paymentMethod == 'MOMO')
                <img src="{{ asset('admin/assets/images/icon/icon_momo.png') }}" class="icon_payment" alt="">
            @elseif (isset($booking->checkout) && $booking->checkout->paymentMethod == 'VNPAY')
                <img src="{{ asset('admin/assets/images/icon/icon_vnpay.png') }}" class="icon_payment" alt="">
            @else
                <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}" class="icon_payment" alt="">
            @endif
        </td>
        <td>
            @if (isset($booking->checkout) && $booking->checkout->paymentStatus == 'unpaid')
                <span class="badge badge-danger">Chưa thanh toán</span>
            @else
                <span class="badge badge-success">Đã thanh toán</span>
            @endif
        </td>

        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(71px, 38px, 0px);">
                    @if ($booking->bookingStatus == 'p')
                    <a class="dropdown-item confirm-booking" href="javascript:void(0)" data-bookingId="{{ $booking->bookingId }}"
                        data-urlConfirm="{{ route('admin.confirm-booking') }}">Xác nhận</a>
                    @endif
                    <a class="dropdown-item finish-booking {{ $booking->hide ?? '' }}" href="javascript:void(0)" data-bookingId="{{ $booking->bookingId }}"
                        data-urlfinish="{{ route('admin.finish-booking') }}">Đã hoàn thành</a>
                    <a class="dropdown-item" href="{{ route('admin.booking-detail',['id' => $booking->bookingId]) }}">Xem chi tiết</a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
