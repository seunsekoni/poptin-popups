<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DONTSHOW()
 * @method static static SHOW()
 */
final class StatusEnum extends Enum
{
    public const DONTSHOW = 0;
    public const SHOW = 1;
}
