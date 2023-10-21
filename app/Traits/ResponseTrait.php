<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    /**
     * Success response.
     *
     * @param array|object $data
     * @param string $message
     *
     * @return JsonResponse
     */
    public function responseSuccess($data, $message = "Successful"): JsonResponse
    {
        return response()->json([
            'status' => "success",
            'message' => $message,
            'data' => $data,
            'errors' => null
        ], Response::HTTP_OK);
    }

    /**
     * Error response.
     *
     * @param array|object $errors
     * @param string $message
     * @param int $responseCode
     *
     * @return JsonResponse
     */
    public function responseError($errors, $message = "Something went wrong."): JsonResponse
    {
        return response()->json([
            'status' => "failed",
            'message' => $message,
            'data' => null,
            'errors' => $errors
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
