<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents billing intervals for subscription plans.
 */
enum PlanInterval: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case BI_ANNUALLY = 'biannually';
    case ANNUALLY = 'annually';
}
