<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblTour;
use App\Models\TblBooking;
use App\Models\TblCheckout;
use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
    public function getSummary() {
        return [
            'tourWorking' => TblTour::where('availability', 1)->count(),
            'countBooking' => TblBooking::where('bookingStatus', '!=', 'c')->count(),
            'totalAmount' => TblCheckout::where('paymentStatus', 'paid')->sum('amount'), // Sửa 'y' thành 'paid' theo SQL
        ];
    }

    public function getValueDomain() {
        return TblTour::selectRaw('domain, COUNT(*) as count')
            ->whereIn('domain', ['b', 't', 'n'])
            ->groupBy('domain')
            ->pluck('count', 'domain');
    }

    public function getValuePayment() {
        return TblCheckout::selectRaw('paymentMethod, COUNT(*) as count')
            ->groupBy('paymentMethod')
            ->get()->toArray();
    }

    public function getMostTourBooked() {
        return TblTour::withSum('bookings as booked_quantity', DB::raw('numAdults + numChildren'))
            ->orderByDesc('booked_quantity')
            ->take(3)->get();
    }

    public function getNewBooking() {
        return TblBooking::with('tour')->where('bookingStatus', 'p') // Sửa 'b' thành 'p' (pending) theo DB gốc
            ->orderByDesc('bookingDate')
            ->take(3)->get();
    }

    public function getRevenuePerMonth() {
        $monthlyRevenue = TblBooking::selectRaw('MONTH(bookingDate) as month, SUM(totalPrice) as revenue')
            ->where('paymentStatus', 'paid')
            ->groupByRaw('MONTH(bookingDate)')
            ->orderBy('month', 'asc')
            ->get();

        $revenueData = array_fill(0, 12, 0);
        foreach ($monthlyRevenue as $data) {
            $revenueData[$data->month - 1] = $data->revenue;
        }
        return $revenueData;
    }
}
