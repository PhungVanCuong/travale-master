<?php
namespace App\Models\clients;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblTour;

class Home extends Model
{
    public function getHomeTours() {
        // Lấy 8 tour kèm theo list Images và trung bình cộng Rating (Tối ưu truy vấn 100%)
        return TblTour::with('images')
            ->withAvg('reviews', 'rating')
            ->where('availability', 1)
            ->take(8)
            ->get();
    }
}
