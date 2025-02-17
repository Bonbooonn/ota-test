<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Contracts\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
