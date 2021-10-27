<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{

    public function commonErrorResponse($error, $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(['error' => $error], $code);
    }

    public function commonSuccessResponse($data, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }
}
