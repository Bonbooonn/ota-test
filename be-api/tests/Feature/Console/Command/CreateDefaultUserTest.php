<?php

namespace tests\Feature\Console\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateDefaultUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_creates_user(): void
    {
        $this->artisan('app:create-default-user')
            ->expectsQuestion('Enter the user name', 'John Doe')
            ->expectsQuestion('Enter the user email', 'test@example.com')
            ->expectsQuestion('Enter the user password', 'password');

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
        ]);

    }
}
