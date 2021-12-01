<?php

namespace App\traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    private function successResponse($data , $code): JsonResponse
    {
        return response()->json(['data' => $data] , $code);
    }

    private function singleSuccessResponse($data , $code): JsonResponse
    {
        return response()->json($data , $code);
    }

    protected function showAll(Collection $data , $code = 200): JsonResponse
    {
        return $this->successResponse($data , $code);
    }

    public function showOne($data , $code = 200): JsonResponse
    {
        return $this->singleSuccessResponse($data , $code);
    }

    protected function errorResponse($message , $code): JsonResponse
    {
        return response()->json(['message' => $message , 'code' => $code] , $code);
    }


}
