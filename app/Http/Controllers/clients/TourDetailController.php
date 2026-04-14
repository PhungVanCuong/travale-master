<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TourDetailController extends Controller
{
    private $tours;

    public function __construct()
    {
        parent::__construct();
        $this->tours = new Tours();
    }

    public function index($id = 0)
    {
        $title = 'Chi tiết tours';
        $userId = $this->getUserId();

        $tourDetail = $this->tours->getTourDetail($id);
        $getReviews = $this->tours->getReviews($id);
        $reviewStats = $this->tours->reviewStats($id);

        $avgStar = round($reviewStats->averageRating);
        $countReview = $reviewStats->reviewCount;

        $checkReviewExist = $this->tours->checkReviewExist($id, $userId);
        if (!$checkReviewExist) {
            $checkDisplay = '';
        } else {
            $checkDisplay = 'hide';
        }

        try {
            $apiUrl = 'http://127.0.0.1:5555/api/tour-recommendations';
            $response = Http::get($apiUrl, [
                'tour_id' => $id
            ]);

            if ($response->successful()) {
                $relatedTours = $response->json('related_tours');
            } else {
                $relatedTours = [];
            }
        } catch (\Exception $e) {
            $relatedTours = [];
            Log::error('Lỗi khi gọi API liên quan: ' . $e->getMessage());
        }

        $id_toursRe = $relatedTours;
        $tourRecommendations = $this->tours->toursRecommendation($id_toursRe);

        return view('clients.tour-detail', compact('title', 'tourDetail', 'getReviews', 'avgStar', 'countReview', 'checkDisplay', 'tourRecommendations'));
    }

    public function reviews(Request $req)
    {
        $userId = $this->getUserId();
        $tourId = $req->tourId;
        $message = $req->message;
        $star = $req->rating;

        $dataReview = [
            'tourId'    => $tourId,
            'userId'    => $userId,
            'comment'   => $message,
            'rating'    => $star,
            'timestamp' => Carbon::now() // Cập nhật thời gian vào DB
        ];

        $rating = $this->tours->createReviews($dataReview);
        if (!$rating) {
            return response()->json([
                'error' => true
            ], 500);
        }

        $getReviews = $this->tours->getReviews($tourId);
        $reviewStats = $this->tours->reviewStats($tourId);

        $avgStar = round($reviewStats->averageRating);
        $countReview = $reviewStats->reviewCount;

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá của bạn đã được gửi thành công!',
            'data' => [
                'avgStar' => $avgStar,
                'countReview' => $countReview,
                'reviewsHTML' => view('clients.partials.reviews', compact('getReviews', 'avgStar', 'countReview'))->render()
            ]
        ]);
    }
}
