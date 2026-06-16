<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Defines who bears the Paystack transaction charges.
 */
enum Bearer: string
{
    case ACCOUNT = 'account';
    case SUB_ACCOUNT = 'subaccount';
    case ALL_PROPORTIONAL = 'all-proportional';
    case ALL = 'all';
}
