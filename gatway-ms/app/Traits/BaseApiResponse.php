<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait BaseApiResponse
{
    /**
     * @param string $message
     * @param string|array|mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public function success($message, $data = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * @param string|array $message
     * @param int $code
     * @param string $status
     * @return JsonResponse
     */
    public function error($message, $code = Response::HTTP_INTERNAL_SERVER_ERROR, $status = "error")
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
        ], $code);
    }
}
