<?php

namespace App\Enums;

use App\Enums\Concerns\EnumsToArray;
use App\Enums\Concerns\Label;

enum EmploymentType: string
{
    use EnumsToArray;
    use Label;

    case Permanent = 'permanent';
    case Contractual = 'contractual';
    case Internship = 'internship';
}
