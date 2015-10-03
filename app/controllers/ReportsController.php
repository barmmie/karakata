<?php

class ReportsController extends \BaseController
{

    /**
     * Display a listing of the resource.
     * GET /reports
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /reports/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /reports
     *
     * @return Response
     */
    public function store()
    {
        $result = $this->execute('Karakata\Report\Command\ReportItemCommand');

        if ($result['success']) {
            return Response::json($result, 200);
        } else {
            return Response::json($result, 400);

        }
    }

    /**
     * Display the specified resource.
     * GET /reports/{id}
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
     * GET /reports/{id}/edit
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
     * PUT /reports/{id}
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
     * DELETE /reports/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}