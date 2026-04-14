<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblTour;
use App\Models\TblImage;
use Illuminate\Support\Facades\DB;

class ToursModel extends Model
{
    public function getAllTours() {
        return TblTour::orderByDesc('tourId')->get();
    }

    public function createTours($data) {
        $tour = TblTour::create($data);
        return $tour->tourId;
    }

    public function uploadImages($data) {
        return TblImage::insert($data);
    }

    public function uploadTempImages($data) {
        return DB::table('tbl_temp_images')->insert($data);
    }

    public function addTimeLine($data) {
        return DB::table('tbl_timeline')->insert($data);
    }

    public function updateTour($tourId, $data) {
        return TblTour::where('tourId', $tourId)->update($data);
    }

    public function deleteTour($tourId) {
        try {
            // Nhờ onDelete('cascade') ở Migrations, xóa Tour sẽ tự động xóa Image và Timeline liên quan
            TblTour::where('tourId', $tourId)->delete();
            return ['success' => true, 'message' => 'Tour đã được xóa thành công.'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Không thể xóa tour. Lỗi: ' . $e->getMessage()];
        }
    }

    public function getTour($tourId) {
        return TblTour::where('tourId', $tourId)->first();
    }

    public function getImages($tourId) {
        return TblImage::where('tourId', $tourId)->get();
    }

    public function getTimeLine($tourId) {
        return DB::table('tbl_timeline')->where('tourId', $tourId)->get();
    }

    public function deleteData($tourId, $tbl) {
        return DB::table($tbl)->where('tourId', $tourId)->delete();
    }
}
