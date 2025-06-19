<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    /**
     * @param object|array $data
     * @param int          $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithData(object|array $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse([
            'statusCode' => $statusCode,
            'data'       => $data,
        ], $statusCode);
    }

    /**
     * @param string $message
     * @param int    $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCustomError(string $message, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return $this->respondWithData([
            'error' => $message,
        ], $statusCode ?: Response::HTTP_BAD_REQUEST);
    }
}
