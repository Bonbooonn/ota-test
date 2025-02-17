<?php

namespace Tests\Feature\Controllers\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthenticateControllerTest extends TestCase
{
    use RefreshDatabase;

    private const string ROUTE_NAME = 'user.authenticate';

    public function test_it_should_return_200_when_user_authenticated(): void
    {
        $routeName = route(self::ROUTE_NAME);

        $user = User::factory()->create();

        $response = $this->postJson($routeName, [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_it_should_return_404_when_user_not_found(): void
    {
        $routeName = route(self::ROUTE_NAME);

        $response = $this->postJson($routeName, [
            'email' => 'test123@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_it_should_return_401_when_password_is_invalid(): void
    {
        $routeName = route(self::ROUTE_NAME);

        $user = User::factory()->create();

        $response = $this->postJson($routeName, [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    #[DataProvider('provideInvalidData')]
    public function test_it_should_return_422_when_fields_are_empty(array $data, array $expectedErrors): void
    {
        $routeName = route(self::ROUTE_NAME);

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
            'email empty' => [
                [
                    'email' => '',
                    'password' => 'password',
                ],
                [
                    'email' => 'The email field is required.',
                ],
            ],
            'password empty' => [
                [
                    'email' => 'test@example.com',
                    'password' => '',
                ],
                [
                    'password' => 'The password field is required.',
                ],
            ],
        ];
    }
}
