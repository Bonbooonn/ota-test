<?php

namespace App\Http\Controllers\JobPosts;

use App\Http\Controllers\Controller;
use App\Services\JobPostsService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetCombinedJobPostController extends Controller
{
    public function __construct(private readonly JobPostsService $service)
    {
    }

    /**
     * @throws ConnectionException
     */
    public function __invoke(Request $request)
    {
        $response = $this->service->getCombinedJobPosts();

        return response()->json([
            'message' => 'Combined job posts retrieved successfully',
            'data' => $response
        ], Response::HTTP_OK);
    }
}
