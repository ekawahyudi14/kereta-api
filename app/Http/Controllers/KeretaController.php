<?php

namespace App\Http\Controllers;

use App\Models\Kereta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Kereta\StoreRequest;
use App\Http\Requests\Kereta\UpdateRequest;
use App\Http\Resources\KeretaResource;
use App\Http\Responses\ApiResponse;

class KeretaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kereta::all();
        $resource = KeretaResource::collection($data);
        return ApiResponse::success('displaying all trains data', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $kereta = Kereta::create(request(['nama']));
        $resource = new KeretaResource($kereta);

        return ApiResponse::success('train has been created successfully', $resource);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kereta  $kereta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kereta = Kereta::find($id);
        if (!$kereta) return ApiResponse::failed('train data not found');

        $resource = new KeretaResource($kereta);
        return ApiResponse::success('showing train data', $resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kereta  $kereta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $kereta = Kereta::find($id);
        if (!$kereta) return ApiResponse::failed('train data not found');

        $kereta->update(request(['nama']));
        $resource = new KeretaResource($kereta);
        return ApiResponse::success('data train has been updated successfully', $resource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kereta  $kereta
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $kereta = Kereta::find($id);
        if (!$kereta) return ApiResponse::failed('train data not found');

        $kereta->delete();
        return ApiResponse::success('data train has been deleted successfully');
    }
}
