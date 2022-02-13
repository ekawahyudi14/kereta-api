<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stasiun\StoreRequest;
use App\Http\Requests\Stasiun\UpdateRequest;
use App\Http\Resources\StasiunResource;

class StasiunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Stasiun::all();
        $resource = StasiunResource::collection($data);
        return ApiResponse::success('displaying all stasiun data', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $stasiun = Stasiun::create(request(['nama']));
        $resource = new StasiunResource($stasiun);

        return ApiResponse::success('stasiun has been created successfully', $resource);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stasiun  $stasiun
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stasiun = Stasiun::find($id);
        if (!$stasiun) return ApiResponse::failed('stasiun data not found');

        $resource = new StasiunResource($stasiun);

        return ApiResponse::success('displaying stasiun data', $resource);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stasiun  $stasiun
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stasiun  $stasiun
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $stasiun = Stasiun::find($id);
        if (!$stasiun) return ApiResponse::failed('stasiun data not found');

        $stasiun->update(request(['nama']));
        $resource = new StasiunResource($stasiun);

        return ApiResponse::success('updating stasiun data', $resource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stasiun  $stasiun
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $stasiun = Stasiun::find($id);
        if (!$stasiun) return ApiResponse::failed('stasiun data not found');

        $stasiun->delete();

        return ApiResponse::success('delete stasiun data');
    }
}
