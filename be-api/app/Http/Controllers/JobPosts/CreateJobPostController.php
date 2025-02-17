<?php

namespace App\Http\Controllers\JobPosts;

use App\DTOs\CreateJobPost;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPost\CreateJobPostRequest;
use App\Services\Contracts\JobPostsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CreateJobPostController extends Controller
{
    public function __construct(private readonly JobPostsServiceInterface $service)
    {
        //
    }

    public function __invoke(CreateJobPostRequest $request): JsonResponse
    {
        $dto = new CreateJobPost(
            name: $request->validated('name'),
            description: $request->validated('description'),
            office: $request->validated('office'),
            department: $request->validated('department'),
            employmentType: $request->validated('employment_type'),
            experience: $request->validated('experience'),
            schedule: $request->validated('schedule'),
            seniority: $request->validated('seniority'),
            creatorEmail: $request->validated('creator_email'),
            jobBoard: $request->input('job_board')
        );

        $response = $this->service->createJobPost($dto);

        return response()->json([
            'message' => 'Job post created successfully',
            'data' => $response
        ], Response::HTTP_CREATED);
    }
}
