<?php

namespace app\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobPostsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RejectJobPostController extends Controller
{
    public function __construct(private readonly JobPostsServiceInterface $service)
    {
        //
    }

    public function __invoke(Request $request, int $jobPostId)
    {
        $response = $this->service->approveRejectJobPost($jobPostId, false);

        return response()->json([
            'message' => 'Job post rejected successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
