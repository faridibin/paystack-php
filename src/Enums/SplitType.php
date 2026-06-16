<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents the type of split transaction.
 */
enum SplitType: string
{
    case PERCENTAGE = 'percentage';
    case FLAT = 'flat';
}
