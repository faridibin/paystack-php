<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents dedicated virtual account providers.
 */
enum Provider: string
{
    case MTN = 'mtn';
    case AIRTEL_TIGO = 'atl';
    case VODAFONE = 'vod';
    case MPESA = 'mpesa';
    case OZOW = 'ozow';
}
