<?php

namespace App\Listeners;

use App\Events\JobPostCreated;
use App\Models\JobBoard;
use App\Models\JobPost;
use App\Notifications\FirstTimeJobPostCreatedNotification;
use App\Repositories\JobPost\JobPostRepository;
use App\Repositories\JobPost\JobPostRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

readonly class SendJobPostCreationNotification
{
    /**
     * @param  JobPostRepository  $repository
     */
    public function __construct(private JobPostRepositoryInterface $repository)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JobPostCreated $event): void
    {
        $jobPost = $event->jobPost;

        if ($this->repository->checkIfFirstTimePost($jobPost->creator_email)) {
            $jobPost->load('jobBoard');
            /** @var JobBoard $jobBoard */
            $jobBoard = $jobPost->jobBoard;
            $jobBoard->load('user');
            $jobBoard->user->notify(new FirstTimeJobPostCreatedNotification($jobPost));
        }
    }
}
