<?php

namespace App\Http\Controllers\JobBoard;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobBoardServiceInterface;
use App\Services\JobBoardService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetAllJobBoardController extends Controller
{
    /**
     * @param  JobBoardService  $service
     */
    public function __construct(private readonly JobBoardServiceInterface $service)
    {
        //
    }

    public function __invoke(): JsonResponse
    {
        $response = $this->service->getJobBoard();

        return response()->json([
            'message' => 'Job board fetched successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
