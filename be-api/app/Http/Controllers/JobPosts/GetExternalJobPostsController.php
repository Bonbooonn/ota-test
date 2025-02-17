<?php

namespace App\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ExternalJobPostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class GetExternalJobPostsController extends Controller
{
    public function __construct(private readonly ExternalJobPostServiceInterface $service)
    {
        //
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->service->getJobPosts();

        return response()->json([
            'message' => 'External job posts retrieved successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
