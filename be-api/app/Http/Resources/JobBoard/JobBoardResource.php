<?php

namespace app\Http\Resources\JobBoard;

use App\Models\JobBoard;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin JobBoard
 */
class JobBoardResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array{id: int, title: string, description: string}
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
