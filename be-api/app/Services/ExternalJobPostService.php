<?php

namespace App\Services;

use App\Repositories\JobPost\JobPostRepositoryInterface;
use App\Services\Contracts\ExternalJobPostServiceInterface;
use App\Transformers\JobPostTransformer;

readonly class ExternalJobPostService implements ExternalJobPostServiceInterface
{
    public function __construct(
        private JobPostRepositoryInterface $repository,
        private JobPostTransformer $transformer
    ) {
        //
    }

    public function getJobPosts(): array
    {
        $externalJobPosts = $this->repository->all()['position'];
        $transformedJobPosts = [];

        foreach ($externalJobPosts as $externalJobPost) {
            $transformedJobPosts[] = $this->transformer->transformExternal($externalJobPost);
        }

        return $transformedJobPosts;
    }

    public function getJobPost(int $id): array
    {
        $externalJobPost = $this->repository->find($id);

        if (empty($externalJobPost)) {
            return [];
        }

        return $this->transformer->transformExternal($externalJobPost);
    }
}
