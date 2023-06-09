<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules;

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
    public function redirect($message, $data = null, $code = Response::HTTP_PERMANENTLY_REDIRECT)
    {
        return response()->json([
            'status' => 'redirect',
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * @param string|array $message
     * @param int $code
     * @return JsonResponse
     */
    public function error($message, $code)
    {
        return response()->json([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
        ], $code);
    }

}
