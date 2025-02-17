<?php

namespace app\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobPostsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetJobPostController extends Controller
{
    public function __construct(private readonly JobPostsServiceInterface $service)
    {
    }

    public function __invoke(Request $request, int $jobPostId): JsonResponse
    {
        $response = $this->service->getJobPost($jobPostId);

        return response()->json([
            'message' => 'Job post retrieved successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
