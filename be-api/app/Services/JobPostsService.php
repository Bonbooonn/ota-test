<?php

namespace App\Services;

use App\DTOs\CreateJobPost;
use App\Http\Resources\JobPost\JobPostResource;
use App\Repositories\JobPost\ExternalJobPostRepository;
use App\Repositories\JobPost\JobPostRepository;
use App\Repositories\JobPost\JobPostRepositoryInterface;
use App\Services\Contracts\JobPostsServiceInterface;
use App\Transformers\JobPostTransformer;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

readonly class JobPostsService implements JobPostsServiceInterface
{
    /**
     * @param  JobPostRepository  $repository
     * @param JobPostTransformer  $transformer
     */
    public function __construct(
        private JobPostRepositoryInterface $repository,
        private JobPostTransformer $transformer,
    ) {
        //
    }

    public function createJobPost(CreateJobPost $dto): JobPostResource
    {
        $creatorEmail = $dto->getCreatorEmail();
        $jobBoard = $dto->getJobBoard();
        $jobPost = $this->repository->create([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
            'office' => $dto->getOffice(),
            'department' => $dto->getDepartment(),
            'employment_type' => $dto->getEmploymentType(),
            'experience' => $dto->getExperience(),
            'schedule' => $dto->getSchedule(),
            'seniority' => $dto->getSeniority(),
            'creator_email' => $creatorEmail,
            'job_board_id' => $jobBoard->id,
        ]);

        return new JobPostResource($jobPost);
    }

    public function getJobPost(int $id): JobPostResource
    {
        $jobPost = $this->repository->find($id);
        $jobPost->load('jobBoard');

        return new JobPostResource($jobPost);
    }

    public function getJobPosts(): ResourceCollection
    {
        return JobPostResource::collection($this->repository->all());
    }

    /**
     * @throws ConnectionException
     */
    public function getCombinedJobPosts(): Collection
    {
        $externalRepository = new ExternalJobPostRepository();
        $internalJobPosts = $this->repository->getAllPublished();
        $externalJobPosts = collect($externalRepository->all());

        return $this->transformer->transform($internalJobPosts, $externalJobPosts);
    }

    public function approveRejectJobPost(int $id, bool $status): JobPostResource
    {
        $jobPost = $this->repository->find($id);
        $jobPost->is_published = $status;
        $jobPost->save();

        $jobPost->load('jobBoard');

        return new JobPostResource($jobPost);
    }
}
