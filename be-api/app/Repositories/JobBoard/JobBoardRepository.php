<?php

namespace App\Repositories\JobBoard;

use App\Models\JobBoard;
use Illuminate\Database\Eloquent\Collection;

class JobBoardRepository implements JobBoardRepositoryInterface
{
    public function create(array $data): JobBoard
    {
        return JobBoard::create($data);
    }

    public function all(): Collection
    {
        return JobBoard::all();
    }
}
