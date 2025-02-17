<?php

namespace App\Enums;

use App\Enums\Concerns\EnumsToArray;
use App\Enums\Concerns\Label;

enum Seniority: string
{
    use EnumsToArray;
    use Label;

    case Entry = 'entry';
    case Junior = 'junior';
    case Mid = 'mid';
    case Senior = 'senior';
}
