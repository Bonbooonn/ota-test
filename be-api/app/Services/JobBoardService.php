<?php

namespace App\Services;

use App\DTOs\CreateJobBoard;
use App\Http\Resources\JobBoard\JobBoardResource;
use App\Repositories\JobBoard\JobBoardRepositoryInterface;
use App\Services\Contracts\JobBoardServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class JobBoardService implements JobBoardServiceInterface
{
    public function __construct(private JobBoardRepositoryInterface $repository)
    {
    }

    /**
     * @param  CreateJobBoard  $dto
     * @return JobBoardResource
     */
    public function createJobBoard(CreateJobBoard $dto): JobBoardResource
    {
        $params = [
            'title' => $dto->getTitle(),
            'description' => $dto->getDescription(),
            'user_id' => $dto->getUser()->id,
        ];

        $JobBoard = $this->repository->create($params);

        return new JobBoardResource($JobBoard);
    }

    public function getJobBoard(): ResourceCollection
    {
        $response = $this->repository->all();

        return JobBoardResource::collection($response);
    }
}
