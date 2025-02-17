<?php

namespace app\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ExternalJobPostServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetExternalJobPostController extends Controller
{
    public function __construct(private readonly ExternalJobPostServiceInterface $service)
    {
        //
    }

    public function __invoke(Request $request, int $jobPostId)
    {
        $response = $this->service->getJobPost($jobPostId);

        return response()->json([
            'message' => 'External job post retrieved successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
