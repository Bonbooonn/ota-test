<?php

namespace Tests\Feature\Controllers\JobPosts;

use App\Enums\EmploymentType;
use App\Enums\Schedule;
use App\Enums\Seniority;
use App\Models\JobBoard;
use App\Models\JobPost;
use App\Models\User;
use App\Notifications\FirstTimeJobPostCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateJobPostControllerTest extends TestCase
{
    use RefreshDatabase;

    private const string ROUTE_NAME = 'job-post.create';

    /**
     * @throws \Exception
     */
    #[DataProvider('provideValidData')]
    public function test_it_should_return_201_when_job_post_created(array $data): void
    {
        Notification::fake();
        $routeName = route(self::ROUTE_NAME);

        /** @var JobBoard $jobBoard */
        $jobBoard = JobBoard::factory()->create();
        $user = $jobBoard->user;

        $data['job_board_id'] = $jobBoard->id;

        $response = $this->postJson($routeName, $data);

        $response->assertStatus(Response::HTTP_CREATED);
        Notification::assertSentTo(
            [$user],
            FirstTimeJobPostCreatedNotification::class,
        );
    }

    #[DataProvider('provideValidData')]
    public function test_it_should_return_200_when_user_creates_another_job_post(array $data): void
    {
        $routeName = route(self::ROUTE_NAME);

        /** @var JobBoard $jobBoard */
        $jobBoard = JobBoard::factory()->create();
        JobPost::factory()->create([
            'job_board_id' => $jobBoard->id,
        ]);

        $data['job_board_id'] = $jobBoard->id;

        $response = $this->postJson($routeName, $data);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    #[DataProvider('provideInvalidData')]
    public function test_it_should_return_422_when_fields_are_empty(array $data, array $expectedErrors): void
    {
        $routeName = route(self::ROUTE_NAME);
        /** @var JobBoard $jobBoard */
        $jobBoard = JobBoard::factory()->create();
        $data['job_board_id'] = $jobBoard->id;

        $response = $this->postJson($routeName, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        foreach ($expectedErrors as $field => $message) {
            $response->assertJsonValidationErrors([$field]);
            $this->assertEquals($message, $response->json('errors')[$field][0]);
        }
    }

    /**
     * @throws \Exception
     */
    public static function provideInvalidData(): array
    {
        return [
            'name empty' => [
                [
                    'name' => '',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ],
                [
                    'name' => 'The name field is required.',
                ],
            ],
            'description empty' => [
                [
                    'name' => 'Job name',
                    'description' => '',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ],
                [
                    'description' => 'The description field is required.',
                ],
            ],
            'office empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => '',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ],
                [
                    'office' => 'The office field is required.',
                ],
            ],
            'department empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => '',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ],
                [
                    'department' => 'The department field is required.',
                ],
            ],
            'employment_type empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => '',
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email,
                ],
                [
                    'employment_type' => 'The employment type field is required.',
                ],
            ],
            'experience empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ],
                [
                    'experience' => 'The experience field is required.',
                ],
            ],
            'schedule empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => '',
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ],
                [
                    'schedule' => 'The schedule field is required.',
                ],
            ],
            'seniority empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => '',
                    'creator_email' => fake()->email
                ],
                [
                    'seniority' => 'The seniority field is required.',
                ],
            ],
            'creator_email empty' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => ''
                ],
                [
                    'creator_email' => 'The creator email field is required.',
                ],
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    public static function provideValidData(): array
    {
        return [
            'valid data' => [
                [
                    'name' => 'Job name',
                    'description' => 'Job Description',
                    'office' => 'Office',
                    'department' => 'Department',
                    'employment_type' => collect(EmploymentType::toArray())->random(),
                    'experience' => '3 years',
                    'schedule' => collect(Schedule::toArray())->random(),
                    'seniority' => collect(Seniority::toArray())->random(),
                    'creator_email' => fake()->email
                ]
            ],
        ];
    }
}
