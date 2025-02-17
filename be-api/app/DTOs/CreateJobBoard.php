<?php

namespace App\DTOs;

use App\Models\User;

readonly class CreateJobBoard
{
    public function __construct(
        private string $title,
        private string $description,
        private User $user
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
