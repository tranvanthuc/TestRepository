<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data, $status = 200)
    {
        return response()->json([
            'status' => true,
            'data'   => $data,
            'error' => [
                'code' => 0 ,
                'message' => []
            ]
        ], $status);
    }

    public function error($message, $status = 400)
    {
        return response()->json([
            'status' => false,
            'data' => [],
            'error' => [
                'code' => $status,
                'message' => $message
            ]
        ], $status);
    }
}
