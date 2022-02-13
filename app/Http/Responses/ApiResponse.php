<?php

namespace App\Http\Responses;

class ApiResponse
{
    public static function success($msg, $data = null)
    {
        $response['status'] = 'success';
        $response['message'] = $msg;
        if ($data) $response['result'] = $data;

        return response()->json($response);
    }

    public static function failed($msg)
    {
        $response['status'] = 'failed';
        $response['message'] = $msg;

        return response()->json($response);
    }
}
