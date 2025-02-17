<x-mail::message>
# A New Job Post Has Been Created

**Job Post Title:** {{ $jobPost->name }}

**Job Post Description:** {{ $jobPost->description }}

<x-mail::button :url="\App\Enums\FrontendUrls::PUBLISH_JOB_POST->value . $jobPost->id">
    Approve Job Post
</x-mail::button>

<x-mail::button :url="App\Enums\FrontendUrls::REJECT_JOB_POST->value . $jobPost->id">
    Reject Job Post
</x-mail::button>

Thank you,<br>
Ota
</x-mail::message>
