<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents the operational health levels of the Paystack platform.
 */
enum Health: string
{
    case HEALTHY = 'healthy';
    case DEGRADED = 'degraded';
    case POOR = 'poor';
    case CRITICAL = 'critical';
}
