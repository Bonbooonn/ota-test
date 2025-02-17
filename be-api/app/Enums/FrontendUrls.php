<?php

namespace App\Enums;

enum FrontendUrls: string
{
    case PUBLISH_JOB_POST = 'http://ota-test.local/publish-job-post/1/';
    case REJECT_JOB_POST = 'http://ota-test.local/publish-job-post/0/';
}
