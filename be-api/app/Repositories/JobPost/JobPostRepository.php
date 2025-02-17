<?php

namespace App\Repositories\JobPost;

use App\Models\JobPost;
use Illuminate\Database\Eloquent\Collection;

class JobPostRepository implements JobPostRepositoryInterface
{

    public function create(array $data): JobPost
    {
        return JobPost::create($data);
    }

    public function find($id): ?JobPost
    {
        return JobPost::find($id);
    }

    public function all(): Collection
    {
        return JobPost::all();
    }

    public function getAllPublished(): Collection
    {
        return JobPost::where('is_published', true)->get();
    }

    public function checkIfFirstTimePost(string $creatorEmail): bool
    {
        $jobPostsCount = JobPost::where('creator_email', $creatorEmail)->count();
        if ($jobPostsCount === 1) {
            return true;
        }

        return false;
    }
}
