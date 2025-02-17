<?php

namespace Tests\Feature\Controllers\JobPosts;

use App\Models\JobPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetJobPostsControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $routeName = 'job-post.get-list';

    public function test_successful_response(): void
    {
        $apiRoute = route($this->routeName);

        JobPost::factory()->count(5)->create();

        $response = $this->getJson($apiRoute);

        $responseData = $response->json();
        $response->assertStatus(200);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertCount(5, $responseData['data']);
    }
}
