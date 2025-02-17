<?php

namespace tests\Feature\Controllers\JobPosts;

use App\Models\JobBoard;
use App\Models\JobPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RejectJobPostControllerTest extends TestCase
{
    use RefreshDatabase;

    public const string ROUTE_NAME = 'job-post.reject';

    public function test_successful_response(): void
    {

        /** @var JobBoard $jobBoard */
        $jobBoard = JobBoard::factory()->create();
        $user = $jobBoard->user;
        /** @var JobPost $jobPost */
        $jobPost = JobPost::factory()->create([
            'job_board_id' => $jobBoard->id,
            'is_published' => true,
        ]);

        $route = route(self::ROUTE_NAME, ['id' => $jobPost->id]);
        $this->actingAs($user);

        $response = $this->patchJson($route);

        $responseData = $response->json('data');

        $response->assertStatus(200);
        $this->assertFalse($responseData['is_published']);
    }
}
