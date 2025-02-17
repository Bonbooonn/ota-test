<?php

namespace App\Http\Resources\JobPost;

use App\Models\JobPost;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin JobPost
 */
class JobPostResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array{
     *     id: int,
     *     name: string,
     *     description: string,
     *     office: string,
     *     department: string,
     *     employment_type: string,
     *     experience: string,
     *     schedule: string,
     *     seniority: string,
     *     creator_email: string,
     *     is_published: bool,
     *     job_board: array{id: int, title: string, description: string}|null
     * }
     * @throws Exception
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'office' => $this->office,
            'department' => $this->department,
            'employment_type' => $this->employment_type,
            'experience' => $this->experience,
            'schedule' => $this->schedule,
            'seniority' => $this->seniority,
            'creator_email' => $this->creator_email,
            'is_published' => $this->is_published,
            'created_at' => $this->created_at->format('F j, Y'),
            'is_internal' => true,
            'job_board' => $this->when($this->relationLoaded('jobBoard'), fn() => [
                'id' => $this->jobBoard->id,
                'name' => $this->jobBoard->title,
                'description' => $this->jobBoard->description,
            ]),
        ];
    }
}
