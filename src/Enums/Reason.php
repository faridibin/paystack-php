<?php

namespace Faridibin\Paystack\Enums;

enum Reason: string
{
    case RESEND_OTP = 'resend_otp';
    case TRANSFER = 'transfer';
}
