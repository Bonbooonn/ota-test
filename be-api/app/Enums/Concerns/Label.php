<?php

namespace App\Enums\Concerns;

use Exception;

trait Label
{

    /**
     * @throws Exception
     */
    public function label(): string
    {
        return ucwords(strtolower(str_replace('_', ' ', $this->name)));
    }
}
