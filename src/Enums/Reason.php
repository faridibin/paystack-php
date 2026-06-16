<?php

declare(strict_types=1);

namespace Faridibin\Paystack\Enums;

/**
 * Represents the reasons for resending a transfer OTP.
 */
enum Reason: string
{
    case RESEND_OTP = 'resend_otp';
    case TRANSFER = 'transfer';
    case DISABLE_OTP = 'disable_otp';
}
