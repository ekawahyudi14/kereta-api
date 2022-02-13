<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Jadwal\StoreRequest;
use App\Http\Requests\Jadwal\UpdateRequest;
use App\Http\Resources\JadwalResource;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::with('kereta', 'stasiun_asal', 'stasiun_tujuan');

        foreach (['stasiun_asal_id', 'tanggal', 'jam'] as $param) {
            if (request($param)) {
                $jadwal = $jadwal->where($param, request($param));
            }
        }

        $data = $jadwal->get();
        $resource = JadwalResource::collection($data);
        return ApiResponse::success('menampilkan seluruh jadwal', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $jadwal = Jadwal::create(request()->all());
        $resource = new JadwalResource($jadwal);
        return ApiResponse::success('berhasil menambahkan jadwal', $resource);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) return ApiResponse::failed('Data Jadwal tidak ditemukan');

        $resource = new JadwalResource($jadwal);

        return ApiResponse::success('data jadwal', $resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $request)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) return ApiResponse::failed('Data Jadwal tidak ditemukan');

        $jadwal->update(request()->all());
        $resource = new JadwalResource($jadwal);

        return ApiResponse::success('data jadwal', $resource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) return ApiResponse::failed('Data Jadwal tidak ditemukan');

        $jadwal->delete();

        return ApiResponse::success('data jadwal berhasil dihapus');
    }
}
