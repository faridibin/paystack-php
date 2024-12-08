<?php

namespace Faridibin\Paystack\Enums;

enum Resolution: string
{
    case MERCHANT_ACCEPTED = 'merchant-accepted';
    case DECLINED = 'declined';
}
