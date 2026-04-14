<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new Tours();
    }

    public function index(Request $request)
    {
        $title = 'Tours';
        $tours = $this->tours->getAllTours(9);
        $domain = $this->tours->getDomain();

        $domainsCount = [
            'mien_bac' => optional($domain->firstWhere('domain', 'b'))->count,
            'mien_trung' => optional($domain->firstWhere('domain', 't'))->count,
            'mien_nam' => optional($domain->firstWhere('domain', 'n'))->count,
        ];

        if ($request->ajax()) {
            return response()->json([
                'tours' => view('clients.partials.filter-tours', compact('tours'))->render(),
            ]);
        }

        $toursPopular = $this->tours->toursPopular(2);

        return view('clients.tours', compact('title', 'tours', 'domainsCount', 'toursPopular'));
    }

    public function filterTours(Request $req)
    {
        $conditions = [];
        $sorting = [];

        // Handle price filter
        if ($req->filled('minPrice') && $req->filled('maxPrice')) {
            $conditions[] = ['priceAdult', '>=', $req->minPrice];
            $conditions[] = ['priceAdult', '<=', $req->maxPrice];
        }

        // Handle domain filter
        if ($req->filled('domain')) {
            $conditions[] = ['domain', '=', $req->domain];
        }

        // Handle star filter
        if ($req->filled('filter_star')) {
            $conditions[] = ['averageRating', '>=', $req->filter_star];
        }

        // Handle duration filter
        if ($req->filled('duration')) {
            $duration = $req->duration;
            $time = [
                '3n2d' => '3 Ngày 2 Đêm',
                '4n3d' => '4 Ngày 3 Đêm',
                '5n4d' => '5 Ngày 4 Đêm',
            ];
            $conditions[] = ['time', '=', $time[$duration]];
        }

        // Handle orderby filter
        if ($req->filled('sorting')) {
            $sortingOption = trim($req->sorting);

            if ($sortingOption == 'new') {
                $sorting = ['tourId', 'DESC'];
            } elseif ($sortingOption == 'old') {
                $sorting = ['tourId', 'ASC'];
            } elseif ($sortingOption == "hight-to-low") {
                $sorting = ['priceAdult', 'DESC'];
            } elseif ($sortingOption == "low-to-high") {
                $sorting = ['priceAdult', 'ASC'];
            }
        }

        $tours = $this->tours->filterTours($conditions, $sorting);

        if (!$tours instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $tours = new \Illuminate\Pagination\LengthAwarePaginator(
                $tours,
                count($tours),
                9,
                1,
                ['path' => url()->current()]
            );
        }

        return view('clients.partials.filter-tours', compact('tours'));
    }
}
