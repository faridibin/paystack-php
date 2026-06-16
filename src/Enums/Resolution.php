<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents dispute resolution options.
 */
enum Resolution: string
{
    case MERCHANT_ACCEPTED = 'merchant-accepted';
    case DECLINED = 'declined';
}
