<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelGuidesController extends Controller
{
    public function index()
    {
        $title = 'Hướng dẫn viên';
        return view('clients.travel-guides', compact('title'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
