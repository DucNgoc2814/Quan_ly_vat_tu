<?php

namespace App\Http\Controllers;

use App\Models\Trip_detail;
use App\Http\Requests\StoreTrip_detailRequest;
use App\Http\Requests\UpdateTrip_detailRequest;

class TripDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.components.trip_details.';
    public function index(String $id)
    {
        // $data = Trip_detail::with(['order', 'trip'])->findOrFail($id);
        // return view(self::PATH_VIEW . 'index', compact('data'));

        $data = Trip_detail::whereHas('trip', function ($query) use ($id) {
            $query->where('id', $id);
        })->with(['order', 'trip'])->get();
        return view(self::PATH_VIEW . __FUNCTION__, data: compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrip_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip_detail $trip_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip_detail $trip_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrip_detailRequest $request, Trip_detail $trip_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip_detail $trip_detail)
    {
        //
    }
}
