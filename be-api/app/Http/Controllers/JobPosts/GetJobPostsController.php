<?php

namespace App\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobPostsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetJobPostsController extends Controller
{
    public function __construct(private readonly JobPostsServiceInterface $service)
    {
        //
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->service->getJobPosts();

        return response()->json([
            'message' => 'Job posts retrieved successfully',
            'data' => $response
        ], Response::HTTP_OK);

    }
}
