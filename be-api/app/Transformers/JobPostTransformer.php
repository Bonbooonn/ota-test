<?php

namespace App\Transformers;

use App\Http\Resources\JobPost\JobPostResource;
use App\Models\JobPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class JobPostTransformer
{

    /**
     * @param  JobPost  $jobPost
     * @return JobPostResource
     */
    private function transformInternal(JobPost $jobPost): JobPostResource
    {
        return new JobPostResource($jobPost);
    }

    public function transformExternal(array $job): array
    {
        return [
            'id' => $job['id'],
            'name' => $job['name'],
            'description' => $this->combineJobDescriptions($job['jobDescriptions']['jobDescription']),
            'office' => $job['office'],
            'department' => $job['department'],
            'employment_type' => $job['employmentType'],
            'experience' => $job['yearsOfExperience'],
            'schedule' => $job['schedule'],
            'seniority' => $job['seniority'],
            'creator_email' => null,
            'is_published' => true,
            'created_at' => Carbon::parse($job['createdAt'])->format('F j, Y'),
            'is_internal' => false,
        ];
    }

    private function combineJobDescriptions(array $jobDescriptions): array
    {
        return collect($jobDescriptions)
            ->mapWithKeys(function ($jobDescription) {
                $value = !empty($jobDescription['value']) ? implode(', ', $jobDescription['value']) : '-';
                return [$jobDescription['name'] => $value];
            })
            ->all();
    }

    public function transform(Collection $internal, Collection $external): Collection
    {
        $internalJobPosts = collect();
        if (!$internal->isEmpty()) {
            $internalJobPosts = $internal->map(fn($jobPost) => $this->transformInternal($jobPost));
        }

        $externalJobPosts = collect($external->get('position', []))
            ->map(fn($jobPost) => $this->transformExternal($jobPost));

        return $internalJobPosts->merge($externalJobPosts);
    }
}
