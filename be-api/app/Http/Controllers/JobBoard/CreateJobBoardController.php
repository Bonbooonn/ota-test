<?php

declare(strict_types=1);

namespace App\Http\Controllers\JobBoard;

use App\DTOs\CreateJobBoard;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobBoard\CreateJobBoardRequest;
use App\Services\Contracts\JobBoardServiceInterface;
use App\Services\JobBoardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CreateJobBoardController extends Controller
{
    /**
     * @param  JobBoardService  $service
     */
    public function __construct(private readonly JobBoardServiceInterface $service)
    {
        //
    }

    public function __invoke(CreateJobBoardRequest $request): JsonResponse
    {
        $dto = new CreateJobBoard(
            title: $request->validated('title'),
            description: $request->validated('description'),
            user: auth()->user()
        );

        $response = $this->service->createJobBoard($dto);

        return response()->json([
            'message' => 'Job board created successfully',
            'data' => $response
        ], Response::HTTP_CREATED);
    }
}
