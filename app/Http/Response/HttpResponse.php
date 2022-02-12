<?php

namespace App\Http\Response;

class HttpResponse
{
    public static function success($msg, $data = null, $code = 200)
    {
        $response['code'] = $code;
        $response['success'] = true;
        $response['description'] = $msg;
        if ($data) $response['result'] = $data;
        return response()->json($response);
    }

    public static function error($msg, $code = 500)
    {
        $response['code'] = $code;
        $response['success'] = false;
        $response['description'] = $msg;
        return response()->json($response);
    }
}
