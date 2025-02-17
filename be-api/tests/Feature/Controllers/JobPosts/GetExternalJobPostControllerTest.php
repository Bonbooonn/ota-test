<?php

namespace Tests\Feature\Controllers\JobPosts;

use App\Models\JobPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetExternalJobPostControllerTest extends TestCase
{
    use RefreshDatabase;

    private string $routeName = 'job-post.get-external';

    public function test_successful_response(): void
    {
        JobPost::factory()->count(5)->create();

        $apiRoute = route($this->routeName, ['id' => 965509]);


        $response = $this->getJson($apiRoute);

        $responseData = $response->json();
        $response->assertStatus(200);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertArrayHasKey('data', $responseData);
    }

    public function test_not_found_response(): void
    {
        $apiRoute = route($this->routeName, ['id' => 1111]);

        $response = $this->getJson($apiRoute);

        $responseData = $response->json();
        $response->assertStatus(200);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertEmpty($responseData['data']);
    }
}
