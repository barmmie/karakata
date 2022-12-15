<?php namespace Admin;

use App;
use DB;
use Input;
use Location;
use Request;
use Response;
use View;

class LocationsController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /locations
     *
     * @return Response
     */
    public function index()
    {

        $locations = Location::orderBy('created_at', 'DESC')->get();

        if (Request::ajax()) {
            return Response::json($locations);
        }

        return View::make('admin.locations.list')
            ->with('locations', $locations->toJson());

    }

    /**
     * Show the form for creating a new resource.
     * GET /locations/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /locations
     *
     * @return Response
     */
    public function store()
    {
        try {
            $result = Location::bulkInsert(Input::all());

        } catch (\Exception $e) {
            return Response::json(['error' => $e->getMessage()], 400);

        }

        \Cache::forget('locations.composer');

        return Response::json(['payload' => $result]);
    }

    /**
     * Display the specified resource.
     * GET /locations/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /locations/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /locations/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /locations/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        \Cache::forget('locations.composer');


        return [];

    }

}