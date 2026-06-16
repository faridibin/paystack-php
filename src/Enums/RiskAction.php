<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents the risk action applied to a customer.
 */
enum RiskAction: string
{
    case ALLOW = 'allow';
    case DENY = 'deny';
    case DEFAULT = 'default';
}
