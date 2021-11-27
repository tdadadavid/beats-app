<?php

namespace App\traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse($data , $code = 200): JsonResponse
    {
        return response()->json(['data' => $data] , $code);
    }

    protected function errorResponse($message , $code): JsonResponse
    {
        return response()->json(['message' => $message , 'code' => $code] , $code);
    }


}
