<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    //
    public function logAndRespondWithError(\Exception $e, string $message)
    {
        Log::error($message, [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        $exceptionCode = $e->getCode() !== 0 ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        $code = (is_int($exceptionCode) && $exceptionCode >= 100 && $exceptionCode <= 599)
            ? $exceptionCode
            : 500;

        return response()->json([
            'message' => $message,
            'error' => $e->getMessage()
        ], $code);
    }
}
