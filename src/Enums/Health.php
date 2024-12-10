<?php

namespace Faridibin\Paystack\Enums;

enum Health: string
{
    case HEALTHY = 'healthy';
    case DEGRADED = 'degraded';
    case POOR = 'poor';
    case CRITICAL = 'critical';
}
