<?php

namespace Tests\Feature\Controllers\JobPosts;

use App\Models\JobPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetExternalJobPostsControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $routeName = 'job-post.get-external-list';

    public function test_successful_response(): void
    {
        $apiRoute = route($this->routeName);

        $response = $this->getJson($apiRoute);

        $responseData = $response->json();
        $response->assertStatus(200);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }
}
