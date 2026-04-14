<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\ToursModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToursManagementController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new ToursModel();
    }

    public function index()
    {
        $title = 'Quản lý Tours';
        $tours = $this->tours->getAllTours();

        return view('admin.tours', compact('title', 'tours'));
    }

    public function pageAddTours()
    {
        $title = 'Thêm Tours';
        return view('admin.add-tours', compact('title'));
    }

    public function addTours(Request $request)
    {
        // Lấy dữ liệu với name mới từ view đã sửa
        $titleTour = $request->input('title');
        $destination = $request->input('destination');
        $domain = $request->input('domain');
        $quantity = $request->input('quantity');
        $priceAdult = $request->input('priceAdult');
        $priceChild = $request->input('priceChild');
        $startDateStr = $request->input('startDate');
        $endDateStr = $request->input('endDate');
        $description = $request->input('description');

        $startDate = Carbon::createFromFormat('d/m/Y', $startDateStr)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $endDateStr)->format('Y-m-d');

        // Logic thời gian
        $datetime1 = Carbon::parse($startDate);
        $datetime2 = Carbon::parse($endDate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->days + 1;
        $nights = $days > 1 ? $days - 1 : 0;
        $time = $days > 1 ? "{$days} Ngày {$nights} Đêm" : "1 Ngày";

        $dataTours = [
            'title' => $titleTour,
            'destination' => $destination,
            'domain' => $domain,
            'quantity' => $quantity,
            'priceAdult' => $priceAdult,
            'priceChild' => $priceChild,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'time' => $time,
            'description' => $description,
            'availability' => 1
        ];

        $tourId = $this->tours->createTours($dataTours);

        return response()->json([
            'success' => true,
            'tourId' => $tourId,
            'message' => 'Tour đã được tạo thành công!',
        ]);
    }

    public function addImagesTours(Request $request)
    {
        $images = $request->file('file');
        if (!is_array($images)) {
            $images = [$images];
        }

        foreach ($images as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('admin/assets/images/gallery-tours'), $imageName);

            $dataUpload = [
                'tourId' => 0,
                'imageURL' => $imageName,
            ];

            $this->tours->uploadTempImages($dataUpload);
        }

        return response()->json(['success' => 'Tải lên thành công!']);
    }

    public function addTimeline(Request $request)
    {
        $tourId = $request->input('tourId');

        $imagesData = DB::table('tbl_temp_images')->get();
        if ($imagesData->isNotEmpty()) {
            foreach ($imagesData as $imageData) {
                $image = $imageData->imageURL;
                $dataUpload = [
                    'tourId' => $tourId,
                    'imageURL' => $image,
                    'description' => 'Tour ' . $tourId,
                    'uploadDate' => Carbon::now()
                ];
                $this->tours->uploadImages($dataUpload);
            }
            DB::table('tbl_temp_images')->truncate();
        }

        $timelines = $request->input('timeline');

        if ($timelines && is_array($timelines)) {
            foreach ($timelines as $timeline) {
                $data = [
                    'tourId' => $tourId,
                    'day' => $timeline['title'],
                    'description' => $timeline['itinerary']
                ];
                $this->tours->addTimeLine($data);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Thêm thành công!',
        ]);
    }

    public function getTourEdit(Request $request)
    {
        $tourId = $request->tourId;
        $tourInfo = $this->tours->getTour($tourId);
        $tourImages = $this->tours->getImages($tourId);
        $tourTimeline = $this->tours->getTimeLine($tourId);

        if ($tourInfo->startDate) {
            $tourInfo->startDate = Carbon::parse($tourInfo->startDate)->format('d/m/Y');
        }
        if ($tourInfo->endDate) {
            $tourInfo->endDate = Carbon::parse($tourInfo->endDate)->format('d/m/Y');
        }

        return response()->json([
            'tourInfo' => $tourInfo,
            'tourImages' => $tourImages,
            'tourTimeline' => $tourTimeline,
        ]);
    }

    public function editTour(Request $request)
    {
        $tourId = $request->input('tourId');
        $titleTour = $request->input('title');
        $destination = $request->input('destination');
        $quantity = $request->input('quantity');
        $priceAdult = $request->input('priceAdult');
        $priceChild = $request->input('priceChild');
        $description = $request->input('description');

        $dataTours = [
            'title' => $titleTour,
            'destination' => $destination,
            'quantity' => $quantity,
            'priceAdult' => $priceAdult,
            'priceChild' => $priceChild,
            'description' => $description,
        ];

        $this->tours->updateTour($tourId, $dataTours);

        $this->tours->deleteData($tourId, 'tbl_images');
        $this->tours->deleteData($tourId, 'tbl_timeline');

        $imagesData = DB::table('tbl_temp_images')->get();
        if ($imagesData->isNotEmpty()) {
            foreach ($imagesData as $imageData) {
                $image = $imageData->imageURL;
                $dataUpload = [
                    'tourId' => $tourId,
                    'imageURL' => $image,
                    'description' => $titleTour,
                    'uploadDate' => Carbon::now()
                ];
                $this->tours->uploadImages($dataUpload);
            }
            DB::table('tbl_temp_images')->truncate();
        }

        $timelines = $request->input('timeline');
        if ($timelines && is_array($timelines)) {
            foreach ($timelines as $timeline) {
                $data = [
                    'tourId' => $tourId,
                    'day' => $timeline['title'],
                    'description' => $timeline['itinerary']
                ];
                $this->tours->addTimeLine($data);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Sửa thành công!',
        ]);
    }

    public function deleteTour(Request $request)
    {
        $tourId = $request->tourId;

        $result = $this->tours->deleteTour($tourId);
        $tours = $this->tours->getAllTours();

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => view('admin.partials.list-tours', compact('tours'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result['message']
            ]);
        }
    }
}
