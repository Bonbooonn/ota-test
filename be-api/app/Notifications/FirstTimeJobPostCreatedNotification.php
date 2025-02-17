<?php

namespace App\Notifications;

use App\Models\JobPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class FirstTimeJobPostCreatedNotification extends Notification
{
    use Queueable;

    private JobPost $jobPost;

    /**
     * Create a new notification instance.
     */
    public function __construct(JobPost $jobPost)
    {
        $this->jobPost = $jobPost;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('First Time Job Post Created')
            ->markdown('emails.notifications.first-time-job-post-created', [
                'jobPost' => $this->jobPost
            ]);
    }
}
