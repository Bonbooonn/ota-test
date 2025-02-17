<?php

namespace Tests\Feature\Controllers\JobBoard;

use App\Models\JobBoard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllJobBoardControllerTest extends TestCase
{
    use RefreshDatabase;

    private const string API_URL = 'job-board.get-all';

    public function test_successful_response(): void
    {
        JobBoard::factory()->count(5)->create();
        $apiRoute = route(self::API_URL);

        $response = $this->getJson($apiRoute);

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }
}
