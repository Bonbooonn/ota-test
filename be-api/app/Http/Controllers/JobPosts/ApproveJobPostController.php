<?php

namespace app\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobPostsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApproveJobPostController extends Controller
{
    public function __construct(private readonly JobPostsServiceInterface $service)
    {
        //
    }

    public function __invoke(Request $request, int $jobPostId)
    {
        $response = $this->service->approveRejectJobPost($jobPostId, true);

        return response()->json([
            'message' => 'Job post approved successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
