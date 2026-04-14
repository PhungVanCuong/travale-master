<?php
namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblTour;
use App\Models\TblReview;
use Illuminate\Support\Facades\DB;

class Tours extends Model
{
    public function getAllTours($perPage = 9) {
        return TblTour::with('images')->withAvg('reviews', 'rating')
            ->where('availability', 1)->paginate($perPage);
    }

    public function getTourDetail($id) {
        $tour = TblTour::with(['images' => function($query) { $query->limit(5); }])
            ->where('tourId', $id)->first();

        if($tour) {
            $tour->timeline = DB::table('tbl_timeline')->where('tourId', $id)->get();
        }
        return $tour;
    }

    function getDomain() {
        return TblTour::selectRaw('domain, COUNT(*) as count')
            ->where('availability', 1)->whereIn('domain', ['b', 't', 'n'])
            ->groupBy('domain')->get();
    }

    public function filterTours($filters = [], $sorting = null, $perPage = null) {
        $query = TblTour::with('images')->withAvg('reviews', 'rating')->where('availability', 1);

        foreach ($filters as $filter) {
            if ($filter[0] !== 'averageRating') {
                $query->where($filter[0], $filter[1], $filter[2]);
            } else {
                $query->having('reviews_avg_rating', $filter[1], $filter[2]); // Filter theo alias sinh ra từ withAvg
            }
        }

        if (!empty($sorting)) {
            $query->orderBy($sorting[0], $sorting[1]);
        }

        return $query->get();
    }

    public function updateTours($tourId, $data) {
        return TblTour::where('tourId', $tourId)->update($data);
    }

    public function tourBooked($bookingId, $checkoutId) {
        return TblTour::whereHas('bookings', function($q) use ($bookingId, $checkoutId) {
            $q->where('bookingId', $bookingId)->whereHas('checkout', function($q2) use ($checkoutId){
                $q2->where('checkoutId', $checkoutId);
            });
        })->first();
    }

    public function createReviews($data) {
        return TblReview::create($data);
    }

    public function getReviews($id) {
        return TblReview::with('user')->where('tourId', $id)->orderByDesc('timestamp')->take(3)->get();
    }

    public function reviewStats($id) {
        $stats = TblReview::where('tourId', $id)
            ->selectRaw('AVG(rating) as averageRating, COUNT(*) as reviewCount')->first();
        return $stats;
    }

    public function checkReviewExist($tourId, $userId) {
        return TblReview::where('tourId', $tourId)->where('userId', $userId)->exists();
    }

    public function searchTours($data) {
        $query = TblTour::with('images')->withAvg('reviews', 'rating')->where('availability', 1);

        if (!empty($data['destination'])) $query->where('destination', 'LIKE', '%' . $data['destination'] . '%');
        if (!empty($data['startDate'])) $query->whereDate('startDate', '>=', $data['startDate']);
        if (!empty($data['endDate'])) $query->whereDate('endDate', '<=', $data['endDate']);
        if (!empty($data['keyword'])) {
            $query->where(function ($q) use ($data) {
                $q->where('title', 'LIKE', '%' . $data['keyword'] . '%')
                  ->orWhere('description', 'LIKE', '%' . $data['keyword'] . '%')
                  ->orWhere('time', 'LIKE', '%' . $data['keyword'] . '%');
            });
        }
        return $query->limit(12)->get();
    }

    public function toursRecommendation($ids) {
        if (empty($ids)) return collect();
        return TblTour::with('images')->withAvg('reviews', 'rating')
            ->where('availability', 1)->whereIn('tourId', $ids)
            ->orderByRaw("FIELD(tourId, " . implode(',', $ids) . ")")->get();
    }

    public function toursPopular($quantity) {
        return TblTour::with('images')->withAvg('reviews', 'rating')
            ->withCount(['bookings as totalBookings' => function($q) {
                $q->where('bookingStatus', 'f');
            }])
            ->having('totalBookings', '>', 0)
            ->orderByDesc('totalBookings')->take($quantity)->get();
    }
}
