<?php

namespace App\Enums;

use App\Enums\Concerns\EnumsToArray;
use App\Enums\Concerns\Label;

enum Schedule: string
{
    use EnumsToArray;
    use Label;

    case FullTime = 'full_time';
    case PartTime = 'part_time';
}
