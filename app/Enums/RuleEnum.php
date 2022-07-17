<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PAGES_CONTAIN()
 * @method static static SPECIFIC_PAGE()
 * @method static static PAGES_START_WITH()
 * @method static static PAGES_END_WITH()
 */
final class RuleEnum extends Enum
{
    public const PAGES_CONTAIN = 'pages contain';
    public const SPECIFIC_PAGE = 'specific page';
    public const PAGES_START_WITH = 'pages start with';
    public const PAGES_END_WITH = 'pages end with';
}
