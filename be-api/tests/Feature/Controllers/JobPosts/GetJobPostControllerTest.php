<?php

namespace Tests\Feature\Controllers\JobPosts;

use App\Models\JobPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetJobPostControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $routeName = 'job-post.get';

    public function test_successful_response(): void
    {
        JobPost::factory()->count(5)->create();
        /** @var JobPost $jobPost */
        $jobPost = JobPost::factory()->create();

        $apiRoute = route($this->routeName, ['id' => $jobPost->id]);


        $response = $this->getJson($apiRoute);

        $responseData = $response->json();
        $response->assertStatus(200);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }
}
