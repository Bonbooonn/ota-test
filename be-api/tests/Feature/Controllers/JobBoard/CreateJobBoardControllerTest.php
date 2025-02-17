<?php

namespace Tests\Feature\Controllers\JobBoard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateJobBoardControllerTest extends TestCase
{
    use RefreshDatabase;

    private const string ROUTE_NAME = 'job-board.create';

    public function test_it_should_return_201_when_job_board_created(): void
    {
        $routeName = route(self::ROUTE_NAME);

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson($routeName, [
            'title' => 'Job Title',
            'description' => 'Job Description',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_it_should_return_401_when_user_not_authenticated(): void
    {
        $routeName = route(self::ROUTE_NAME);

        $response = $this->postJson($routeName, [
            'title' => 'Job Title',
            'description' => 'Job Description',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    #[DataProvider('provideInvalidData')]
    public function test_it_should_return_422_when_fields_are_empty(array $data, array $expectedErrors): void
    {
        $routeName = route(self::ROUTE_NAME);

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson($routeName, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        foreach ($expectedErrors as $field => $message) {
            $response->assertJsonValidationErrors([$field]);
            $this->assertEquals($message, $response->json('errors')[$field][0]);
        }
    }

    public static function provideInvalidData(): array
    {
        return [
            'title empty' => [
                [
                    'title' => '',
                    'description' => 'password',
                ],
                [
                    'title' => 'The title field is required.',
                ],
            ],
            'description empty' => [
                [
                    'title' => 'title',
                    'description' => '',
                ],
                [
                    'description' => 'The description field is required.',
                ],
            ],
        ];
    }
}
