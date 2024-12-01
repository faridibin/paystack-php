<?php

namespace Faridibin\Paystack\Enums;

enum Provider: string
{
    case MTN = 'mtn';
    case AIRTEL_TIGO = 'atl';
    case VODAFONE = 'vod';
    case MPESA = 'mpesa';
}
